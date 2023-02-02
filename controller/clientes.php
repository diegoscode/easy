<?php
require_once("../config/conexion.php");
require_once("../models/Clientes.php");
$clientes = new Clientes();

switch ($_GET["op"]) {
    case "guardaryeditar":
        if (empty($_POST["client_id"])) {
            $clientes->insert_clientes($_POST["nom_emp"], $_POST["doc_nac"], $_POST["tip_per"]);
        } else {
            $clientes->update_clientes($_POST["client_id"], $_POST["nom_emp"], $_POST["doc_nac"], $_POST["tip_per"]);
        }
        break;

    case "listar":
        $datos = $clientes->get_clientes();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["client_id"];
            $sub_array[] = $row["nom_emp"];
            $sub_array[] = $row["doc_nac"];
            $sub_array[] = $row["tip_per"];

            $client_estado;

            if ($row["client_est"] == "Activo") {
                $client_estado = "'" . 'Inactivo' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["client_id"] . ',' . $client_estado . ')"><span class="label label-pill label-success">Activo</span></a>';
            } else {
                $client_estado = "'" . 'Activo' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["client_id"] . ',' . $client_estado . ')"><span class="label label-pill label-danger">Inactivo</span></a>';
            }

            $sub_array[] = '<button type="button" onClick="editar(' . $row["client_id"] . ')"  id="' . $row["client_id"] . '" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["client_id"] . ')"  id="' . $row["client_id"] . '" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';

            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data,
        );
        echo json_encode($results);
        break;

    case "eliminar":
        $clientes->delete_clientes($_POST["client_id"]);
        break;

    case "encontrar";
        $datos = $clientes->get_clientes_x_id($_POST["client_id"]);

        echo json_encode($datos);

        break;


    case "cambiarestado";
        $clientes->cambiar_estado($_POST["client_id"], $_POST["estado"]);
        break;
}


?>