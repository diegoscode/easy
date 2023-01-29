<?php
require_once("../config/conexion.php");
require_once("../models/Servicios.php");
$servicios = new Servicios();

switch ($_GET["op"]) {
    case "guardaryeditar":
        if (empty($_POST["num_serv"])) {
            $servicios->insert_servicio($_POST["tip_serv"], $_POST["cat_id"], $_POST["sub_cat"], $_POST["precio"]);
        } else {
            $servicios->update_servicio($_POST["num_serv"], $_POST["tip_serv"], $_POST["cat_id"], $_POST["sub_cat"], $_POST["precio"]);
        }
        break;

    case "listar":
        $datos = $servicios->get_servicio();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["num_serv"];
            $sub_array[] = $row["tip_serv"];
            $sub_array[] = $row["cat_id"];
            $sub_array[] = $row["sub_cat"];
            $sub_array[] = $row["precio"];

            $serv_estado;

            if ($row["serv_est"] == "Disponible") {
                $serv_estado = "'" . 'Inhabilitado' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["num_serv"] . ',' . $serv_estado . ')"><span class="label label-pill label-success">Disponible</span></a>';
            } else {
                $serv_estado = "'" . 'Disponible' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["num_serv"] . ',' . $serv_estado . ')"><span class="label label-pill label-danger">Inhabilitado</span></a>';
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
        $servicios->delete_servicio($_POST["num_serv"]);
        break;

    case "mostrar";
        $datos = $servicios->get_servicio_x_usu($_POST["num_serv"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["num_serv"] = $row["num_serv"];
                $output["tip_serv"] = $row["tip_serv"];
                $output["cat_id"] = $row["cat_id"];
                $output["sub_cat"] = $row["sub_cat"];
                $output["precio"] = $row["precio"];
            }
            echo json_encode($output);
        }
        break;

    case "cambiarestado";
        $servicios->cambiar_estado($_POST["num_serv"], $_POST["estado"]);

}


?>