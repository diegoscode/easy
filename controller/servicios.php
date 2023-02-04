<?php
require_once("../config/conexion.php");
require_once("../models/Servicios.php");
$servicios = new Servicios();

switch ($_GET["op"]) {
    case "guardaryeditar":
        if (empty($_POST["num_serv"])) {
            $servicios->insert_servicios($_POST["tip_serv"], $_POST["cat_serv"], $_POST["sub_cat"], $_POST["cost_serv"]);
        } else {
            $servicios->update_servicios($_POST["num_serv"], $_POST["tip_serv"], $_POST["cat_serv"], $_POST["sub_cat"], $_POST["cost_serv"]);
        }
        break;

    case "listar":
        $datos = $servicios->get_servicios();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["num_serv"];
            $sub_array[] = $row["tip_serv"];
            $sub_array[] = $row["cat_serv"];
            $sub_array[] = $row["sub_cat"];
            $sub_array[] = $row["cost_serv"];

            $servicio_estado;

            if ($row["serv_est"] == "Disponible") {
                $servicio_estado = "'" . 'Inhabilitado' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["num_serv"] . ',' . $servicio_estado . ')"><span class="label label-pill label-success">Disponible</span></a>';
            } else {
                $servicio_estado = "'" . 'Disponible' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["num_serv"] . ',' . $servicio_estado . ')"><span class="label label-pill label-danger">Inhabilitado</span></a>';
            }

            $sub_array[] = '<button type="button" onClick="editar(' . $row["num_serv"] . ')"  id="' . $row["num_serv"] . '" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["num_serv"] . ')"  id="' . $row["num_serv"] . '" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';

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

    case "eliminar":
        $servicios->delete_servicios($_POST["num_serv"]);
        break;

    case "encontrar";
        $datos = $servicios->get_servicios_x_id($_POST["num_serv"]);

        echo json_encode($datos);

        break;

    case "encontrar_varios";
        $datos = $servicios->get_varios_servicios($_POST["servicios"]);

        echo json_encode($datos);
        break;

    case "cambiarestado";
        $servicios->cambiar_estado($_POST["num_serv"], $_POST["estado"]);
        break;
}


?>