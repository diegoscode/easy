<?php
class Contratos extends Conectar
{

    public function insert_contratos($client_id, $cat_serv, $contrato_plan)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO contratos (contrat_id,client_id, contrat_est, fech_contrat, est, contrato_plan) VALUES (NULL, ?, 'Asociado', NOW(), 1, ?);";
        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $client_id);
        $sql->bindValue(2, $contrato_plan);
        $sql->execute();

        $lastInsertedIdContratoSql = "SELECT contrat_id FROM contratos ORDER BY contrat_id DESC LIMIT 1";
        $lastInsertedIdContratoSql = $conectar->prepare($lastInsertedIdContratoSql);
        $lastInsertedIdContratoSql->execute();
        $lastInsertedIdContratoSql = $lastInsertedIdContratoSql->fetch();
        $lastInsertedIdContratoSql = $lastInsertedIdContratoSql['contrat_id'];

        foreach ($cat_serv as $servicio) {
            $serv_sql = "INSERT INTO contrato_servicio (contrat_id, num_serv) VALUES(?, ?)";
            $serv_sql = $conectar->prepare($serv_sql);
            $serv_sql->bindValue(1, $lastInsertedIdContratoSql);
            $serv_sql->bindValue(2, $servicio);
            $serv_sql->execute();
        }

        return $sql->fetch();

    }

    public function update_contratos($contrat_id, $client_id, $servicios, $contrato_plan)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sqlUpdate = "UPDATE contratos SET client_id = ?, contrato_plan = ? WHERE contrat_id = ?";
        $sqlUpdate = $conectar->prepare($sqlUpdate);
        $sqlUpdate->bindValue(1, $client_id);
        $sqlUpdate->bindValue(2, $contrato_plan);
        $sqlUpdate->bindValue(3, $contrat_id);
        $sqlUpdate->execute();

        $sql = "DELETE FROM contrato_servicio WHERE contrat_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $contrat_id);
        $sql->execute();

        foreach ($servicios as $servicio) {
            $serv_sql = "INSERT INTO contrato_servicio (contrat_id, num_serv) VALUES(?, ?)";
            $serv_sql = $conectar->prepare($serv_sql);
            $serv_sql->bindValue(1, $contrat_id);
            $serv_sql->bindValue(2, $servicio);
            $serv_sql->execute();
        }

    }

    public function listar_contratos_x_clientes($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
                contratos.contrat_id,
                contratos.usu_id,
                contratos.nom_emp,
                contratos.tip_serv,
                contratos.cost_serv,
                contratos.contrat_est,
                usuarios.usu_nom,
                usuarios.usu_ape
                FROM 
                contratos
                INNER join usuarios on contratos.usu_id = usuarios.usu_id
                WHERE
                contratos.est = 1
                AND usuarios.usu_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function cambiar_estado($contrat_id, $contrat_est)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $this->console_log($contrat_id);

        $sql = "UPDATE contratos 
        SET 
            contrat_est=?
        where contrat_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $contrat_est);
        $sql->bindValue(2, $contrat_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();

    }

    public function get_contratos_tipos()
    {
        $conectar = parent::Conexion();
        parent::set_names();
        $sql = 'SELECT * FROM contrato_plan';
        $sql = $conectar->prepare($sql);

        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function listar_contratos()
    {
        $conectar = parent::Conexion();
        parent::set_names();
        $sql = "SELECT 
        LPAD(C.contrat_id, 4, 0) AS contrat_id,
        CL.nom_emp AS empresa,
        CP.tipo AS tipo,
        CP.horario AS horario,
        CL.doc_nac AS cedula,
        CL.tip_per AS tip_per,
        JSON_ARRAYAGG(
                JSON_OBJECT(
                'num_serv', S.num_serv,
                'tip_serv', S.tip_serv
            )
        ) AS servicios,
        SUM(S.cost_serv) AS monto,
        C.fech_contrat AS fech_contrat,
        C.contrat_est AS contrat_est,
        C.contrat_id AS contrat_id_raw
        FROM contratos AS C
        INNER JOIN contrato_servicio AS CS
        ON C.contrat_id = CS.contrat_id
        INNER JOIN contrato_plan AS CP
        ON C.contrato_plan = CP.id
        INNER JOIN servicios AS S
        ON S.num_serv = CS.num_serv
        INNER JOIN clientes AS CL
        ON CL.client_id = C.client_id
        WHERE C.est = 1
        GROUP BY C.contrat_id";

        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();

    }

    public function buscar_contrato($contrat_id)
    {
        $conectar = parent::Conexion();
        parent::set_names();
        $sql = "SELECT 
        LPAD(C.contrat_id, 4, 0) AS contrat_id,
        CL.nom_emp AS nom_emp,
        CP.tipo AS tipo,
        C.client_id AS client_id,
        JSON_OBJECT(
                'id', CP.id,
                'plan', CP.tipo,
                'horario', CP.horario
        ) AS contrato_plan,
        CL.doc_nac AS cedula,
        CL.tip_per AS tip_per,
        JSON_ARRAYAGG(
                JSON_OBJECT(
                'num_serv', S.num_serv,
                'tip_serv', S.tip_serv
            )
        ) AS servicios,
        SUM(S.cost_serv) AS cost_serv,
        C.fech_contrat AS fech_contrat,
        C.contrat_est AS contrat_est
        FROM contratos AS C
        INNER JOIN contrato_servicio AS CS
        ON C.contrat_id = CS.contrat_id
        INNER JOIN contrato_plan AS CP
        ON C.contrato_plan = CP.id
        INNER JOIN servicios AS S
        ON S.num_serv = CS.num_serv
        INNER JOIN clientes AS CL
        ON CL.client_id = C.client_id
        WHERE C.est = 1
        AND C.contrat_id = ?";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $contrat_id);
        $sql->execute();
        return $resultado = $sql->fetch();
    }

    public function borrar_contrato($contrat_id)
    {
        $conectar = parent::Conexion();
        parent::set_names();
        $sql = "UPDATE contratos 
            SET 
                est='0'
            where contrat_id=?";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $contrat_id);
        $sql->execute();
    }

    function console_log($output, $with_script_tags = true)
    {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
            ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }


}
?>