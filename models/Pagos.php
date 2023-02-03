<?php
class Pagos extends Conectar
{

    public function insert_pagos($contrat_id, $cat_pag)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO pagos (pag_id, contrat_id, cat_pag, fech_pag, pag_est, est) VALUES (NULL, ?, ?, NOW(), 'Cancelado', 1 );";
        $sql = $conectar->prepare($sql);

        $sqlPago_contrato = "INSERT INTO pago_contrato (pag_id, contrat_id) VALUES (LAST_INSERT_ID() , ?)";
        $sqlPago_contrato = $conectar->prepare($sqlPago_contrato);

        $sql->bindValue(1, $contrat_id);
        $sql->bindValue(2, $cat_pag);

        $sqlPago_contrato->bindValue(1, $contrat_id);

        $sql->execute();
        $sqlPago_contrato->execute();
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
        P.pag_id AS pag_id, 
        CL.nom_emp AS nom_emp,
        CL.doc_nac AS cedula,
        S.tip_serv AS tip_serv,
        S.cost_serv AS cost_serv,
        P.fech_pag AS fech_pag,
        P.pag_est AS pag_est,
        CP.cat_nom AS cat_pag
        FROM pagos AS P 
        INNER JOIN pago_contrato AS PC
        ON P.pag_id = PC.pag_id
        INNER JOIN categoria_pagos AS CP
        ON P.cat_pag = CP.cat_pag
        INNER JOIN contratos as CO
        ON PC.contrat_id = CO.contrat_id
        INNER JOIN clientes AS CL
        ON CO.client_id = CL.client_id
        INNER JOIN servicios AS S
        ON CO.num_serv = S.num_serv

        WHERE P.est = 1";

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