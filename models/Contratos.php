<?php
class Contratos extends Conectar
{

    public function insert_contratos($client_id, $num_serv)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO contratos (contrat_id,client_id, contrat_est, fech_contrat, est, num_serv) VALUES (NULL, ?, 'Asociado', NOW(), 1, ?);";
        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $client_id);
        $sql->bindValue(2, $num_serv);

        $sql->execute();

        return $sql->fetch();

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

    public function listar_contratos()
    {
        $conectar = parent::Conexion();
        parent::set_names();
        $sql = "SELECT 
        C.contrat_id AS contrat_id, 
        CL.nom_emp AS nom_emp,
        CL.doc_nac AS cedula,
        CL.tip_per AS tip_per,
        S.tip_serv AS tip_serv,
        S.cost_serv AS cost_serv,
        C.fech_contrat AS fech_contrat,
        C.contrat_est AS contrat_est
        FROM contratos AS C
        INNER JOIN clientes AS CL
        ON C.client_id = CL.client_id
        INNER JOIN servicios AS S
        ON C.num_serv = S.num_serv
        WHERE C.est = 1";

        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();

    }

    public function buscar_contrato($contrat_id)
    {
        $conectar = parent::Conexion();
        parent::set_names();
        $sql = "SELECT
        C.contrat_id AS contrat_id,
        CL.nom_emp AS nom_emp,
        CL.doc_nac AS cedula,
        CL.tip_per AS tip_per,
        S.tip_serv AS tip_serv,
        S.cost_serv AS cost_serv,
        C.fech_contrat AS fech_contrat,
        C.contrat_est AS contrat_est
        FROM contratos AS C
        INNER JOIN clientes AS CL
        ON C.client_id = CL.client_id
        INNER JOIN servicios AS S
        ON C.num_serv = S.num_serv
        WHERE C.est = 1
        AND C.contrat_id = ?";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $contrat_id);
        $sql->execute();
        return $resultado = $sql->fetch();
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