<?php

class Reportes extends Conectar
{

    function listarReportes($rol_id, $usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();

        if ($rol_id === 2) {
            $sql = 'SELECT reportes.*, LPAD(report_id, 4, 0) as codigo_report  FROM reportes';

        } else {
            $sql = "SELECT reportes.*, LPAD(report_id, 4, 0) as codigo_report FROM reportes WHERE usu_id = $usu_id";
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