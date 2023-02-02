<?php
class Pagos extends Conectar
{

    public function insert_pagos($client_id, $num_serv)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO pagos (pag_id,client_id, pag_est, fech_pag, est, num_serv) VALUES (NULL, ?, 'Cancelado', NOW(), 1, ?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $client_id);
        $sql->bindValue(2, $num_serv);

        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function listar_pagos_x_clientes($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
                pagos.pag_id,
                pagos.usu_id,
                pagos.nom_emp,
                pagos.tip_serv,
                pagos.cost_serv,
                pagos.pag_est,
                usuarios.usu_nom,
                usuarios.usu_ape
                FROM 
                pagos
                INNER join usuarios on pagos.usu_id = usuarios.usu_id
                WHERE
                pagos.est = 1
                AND usuarios.usu_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function cambiar_estado($pag_id, $pag_est)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE pagos 
        SET 
            pag_est=?
        where pag_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $pag_est);
        $sql->bindValue(2, $pag_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();

    }

    public function listar_pagos()
    {
        $conectar = parent::Conexion();
        parent::set_names();
        $sql = "SELECT 
        C.pag_id AS pag_id, 
        CL.nom_emp AS nom_emp,
        CL.doc_nac AS cedula,
        CL.tip_per AS tip_per,
        S.tip_serv AS tip_serv,
        S.cost_serv AS cost_serv,
        C.fech_pag AS fech_pag,
        C.pag_est AS pag_est
        FROM pagos AS C
        INNER JOIN pago_contrato AS PC
        ON CO.pag_id = PC.pag_id
        INNER JOIN contratos as CO
        ON PC.contrat_id = CO.contrat_id
        INNER JOIN clientes AS CL
        ON CO.client_id = CL.client_id
        INNER JOIN servicios AS S
        ON CO.num_serv = S.num_serv
        WHERE C.est = 1";

        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();

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