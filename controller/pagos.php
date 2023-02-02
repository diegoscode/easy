<?php
require_once("../config/conexion.php");
require_once("../models/Pagos.php");
$pagos = new Pagos();

switch ($_GET["op"]) {
    case "insert":
        $pagos->insert_pagos($_POST["pagos_select"], $_POST["cat_serv"]);
        break;

    case "listar":

        $datos = $pagos->listar_pagos();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["pag_id"];
            $sub_array[] = $row["nom_emp"];
            $sub_array[] = $row["cedula"];
            $sub_array[] = $row["tip_per"];
            $sub_array[] = $row["tip_serv"];
            $sub_array[] = $row["cost_serv"];
            $sub_array[] = $row["fech_contrat"];

            $contrato_estado;

            if ($row["contrat_est"] == "Asociado") {
                $contrato_estado = "'" . 'Asociado' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["pag_id"] . ',' . $contrato_estado . ')"><span class="label label-pill label-success">Asociado</span></a>';
            } else {
                $contrato_estado = "'" . 'No asociado' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["pag_id"] . ',' . $contrato_estado . ')"><span class="label label-pill label-danger">No asociado</span></a>';
            }

            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($results);

        break;

    case "listar_x_client":
        $datos = $pagos->listar_pagos_x_clientes($_POST["usu_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["pag_id"];
            $sub_array[] = $row["nom_emp"];
            $sub_array[] = $row["tip_serv"];
            $sub_array[] = $row["doc_nac"];
            $sub_array[] = $row["cost_serv"];

            $contrato_estado;

            if ($row["contrat_est"] == "Abierto") {
                $contrato_estado = "'" . 'Cerrado' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["pag_id"] . ',' . $contrato_estado . ')"><span class="label label-pill label-success">Disponible</span></a>';
            } else {
                $contrato_estado = "'" . 'Abierto' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["pag_id"] . ',' . $contrato_estado . ')"><span class="label label-pill label-danger">Cerrado</span></a>';
            }

            $data[] = $sub_array;
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case "cambiarestado";
        $pagos->cambiar_estado($_POST["pag_id"], $_POST["estado"]);
        break;

}
?>