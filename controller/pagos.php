<?php
require_once("../config/conexion.php");
require_once("../models/Pagos.php");
$pagos = new Pagos();

switch ($_GET["op"]) {
    case "insert":
        $pagos->insert_pagos($_POST["pagos_select"], $_POST["cat_pag"]);
        break;

    case "listar":

        $datos = $pagos->listar_pagos();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["pag_id"];
            $sub_array[] = $row["contrat_id"];
            $sub_array[] = $row["nom_emp"];
            $sub_array[] = $row["cedula"];
            $sub_array[] = $row["cat_pag"];
            $sub_array[] = $row["monto"];
            $sub_array[] = $row["fech_pag"];

            $pago_estado;

            if ($row["pag_est"] == "Cancelado") {
                $pago_estado = "'" . 'Pendiente' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["pag_id"] . ',' . $pago_estado . ')"><span class="label label-pill label-success">Cancelado</span></a>';
            } else {
                $pago_estado = "'" . 'Cancelado' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["pag_id"] . ',' . $pago_estado . ')"><span class="label label-pill label-danger">Pendiente</span></a>';
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

            if ($row["pag_est"] == "Abierto") {
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

    case "total";
            $datos=$pagos->get_pagos_total();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

}
?>