<?php
require_once("../config/conexion.php");
require_once("../models/Contratos.php");
$contratos = new Contratos();

switch ($_GET["op"]) {
    case "insert":
        $contratos->insert_contratos($_POST["contratos_select"], $_POST["cat_serv"]);
        break;

    case "listar":

        $datos = $contratos->listar_contratos();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["contrat_id"];
            $sub_array[] = $row["nom_emp"];
            $sub_array[] = $row["cedula"];
            $sub_array[] = $row["tip_per"];
            $sub_array[] = $row["tip_serv"];
            $sub_array[] = $row["cost_serv"];
            $sub_array[] = $row["fech_contrat"];

            $contrato_estado;

            if ($row["contrat_est"] == "Asociado") {
                $contrato_estado = "'" . 'Asociado' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["contrat_id"] . ',' . $contrato_estado . ')"><span class="label label-pill label-success">Asociado</span></a>';
            } else {
                $contrato_estado = "'" . 'No asociado' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["contrat_id"] . ',' . $contrato_estado . ')"><span class="label label-pill label-danger">No asociado</span></a>';
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
        $datos = $contratos->listar_contratos_x_clientes($_POST["usu_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["contrat_id"];
            $sub_array[] = $row["nom_emp"];
            $sub_array[] = $row["tip_serv"];
            $sub_array[] = $row["cost_serv"];

            $contrato_estado;

            if ($row["contrat_est"] == "Asociado") {
                $contrato_estado = "'" . 'No asociado' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["contrat_id"] . ',' . $contrato_estado . ')"><span class="label label-pill label-success">Asociado</span></a>';
            } else {
                $contrato_estado = "'" . 'Asociado' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["contrat_id"] . ',' . $contrato_estado . ')"><span class="label label-pill label-danger">No asociado</span></a>';
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
        $contratos->cambiar_estado($_POST["contrat_id"], $_POST["estado"]);
        break;

    case "buscar";
        $datos = $contratos->buscar_contrato($_POST['contrat_id']);

        echo json_encode($datos);
        break;

}
?>