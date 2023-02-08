<?php

class Reportes extends Conectar
{

    function listarReportes($rol_id, $usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();

        if ($rol_id == 2) {
            $sql = 'SELECT LPAD(report_id, 4, 0) AS codigo_report,
            report_id,
            CL.doc_nac AS cedula,
            CL.nom_emp AS nombre,
            tip_pag,
            origen,
            fech_trans,
            monto,
            comprobante,
            report_est
            FROM reportes AS R
            INNER JOIN clientes AS CL
            ON CL.usu_id = R.usu_id
            WHERE R.est = 1;';

        } else {
            $sql = "SELECT reportes.*, LPAD(report_id, 4, 0) as codigo_report FROM reportes WHERE usu_id = $usu_id AND est = 1";
        }

        $sql = $conectar->prepare($sql);
        $sql->execute();

        return $sql->fetchAll();
    }

    function encontrarReporte($report_id)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = 'SELECT reportes.*, LPAD(report_id, 4, 0) as codigo_report  FROM reportes WHERE report_id = ?';
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $report_id);
        $sql->execute();

        return $sql->fetch();
    }

    function insert_reporte($usu_id, $numero_referencia, $tip_pag, $origen, $telefono, $comprobante, $monto, $fech_trans)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = 'INSERT INTO reportes (report_id, usu_id, numero_referencia ,tip_pag, origen, telefono, comprobante, monto, fech_trans, report_est, est) VALUES(
            NULL, ?, ?, ?, ?, ?, ?, ?, ?, "Esperando", 1)';
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $numero_referencia);
        $sql->bindValue(3, $tip_pag);
        $sql->bindValue(4, $origen);
        $sql->bindValue(5, $telefono);
        $sql->bindValue(6, $comprobante);
        $sql->bindValue(7, $monto);
        $sql->bindValue(8, $fech_trans);
        $sql->execute();

        return $sql->fetchAll();
    }
}