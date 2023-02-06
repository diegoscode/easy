<?php
require_once("../config/conexion.php");
require_once("../models/Contratos.php");
$contratos = new Contratos();

function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

switch ($_GET["op"]) {
    case "insert":
        $contratos->insert_contratos($_POST["contratos_select"], $_POST["cat_serv"], $_POST['contrato_plan']);
        break;

    case "editar":
        if (count($_POST['servicios']) === 0) {
            return 'se necesita al menos un servicio';
        }
        $contratos->update_contratos($_POST['contrat_id'], $_POST['client_id'], $_POST['servicios'], $_POST['contrato_plan']);
        break;

    case "listar":

        $datos = $contratos->listar_contratos();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["contrat_id"];
            $sub_array[] = $row["empresa"];
            $sub_array[] = $row["tipo"];
            $sub_array[] = $row["horario"];
            $sub_array[] = $row["cedula"];
            $sub_array[] = $row["tip_per"];

            $serviciosJSON = json_decode($row["servicios"]);
            $servicios = '';


            if (count($serviciosJSON) > 1) {
                foreach ($serviciosJSON as $key => $value) {
                    $servicios .= '<li class="dropdown-item" >' . $value->tip_serv . '</li>';
                }

                $sub_array[] = '<div class="dropdown w-100">'
                    . '<button class="dropdown-toggle w-100 servicios-button border border-1 text-start" id="servicios-drop" data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">' . $serviciosJSON[0]->tip_serv . '</button>'
                    . '<div class="dropdown-menu" aria-labelledby="servicios-drop">'
                    . $servicios
                    . '</div>'
                    . '</div>';
            } else {
                $sub_array[] = $serviciosJSON[0]->tip_serv;
            }



            $sub_array[] = $row["monto"];
            $sub_array[] = $row["fech_contrat"];

            $serviciosJSON = json_decode($row['servicios']);
            $serviciosList = array();

            $contrato_estado;

            if ($row["contrat_est"] == "Asociado") {
                $contrato_estado = "'" . 'No Asociado' . "'";
                $sub_array[] = '<a onClick="cambiarEstado(' . $row["contrat_id_raw"] . ',' . $contrato_estado . ')"><span class="label label-pill label-success">Asociado</span></a>';
            } else {
                $contrato_estado = "'" . 'Asociado' . "'";
                $sub_array[] = '<a onClick="cambiarEstado(' . $row["contrat_id_raw"] . ',' . $contrato_estado . ')"><span class="label label-pill label-danger">No Asociado</span></a>';
            }


            $sub_array[] = '<div class="btn-group" role="group">'
                . '<button type="button" class="btn btn-sm btn-primary" onClick="editar(' . $row["contrat_id_raw"] . ')"><i class="fa fa-edit"></i></button>'
                . '<button type="button" class="btn btn-sm btn-danger" onClick="eliminar(' . $row["contrat_id_raw"] . ')" ><i class="fa fa-trash"></i></button>'
                . '</div>';

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

    case "get_contratos":
        $datos = $contratos->get_contratos_tipos();


        echo json_encode($datos);

        break;

    case "borrar_contrato":
        $contratos->borrar_contrato($_POST['contrat_id']);

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
                $sub_array[] = '<a onClick="cambiarEstado(' . $row["contrat_id"] . ',' . $contrato_estado . ')"><span class="label label-pill label-success">Asociado</span></a>';
            } else {
                $contrato_estado = "'" . 'Asociado' . "'";
                $sub_array[] = '<a onClick="cambiarEstado(' . $row["contrat_id"] . ',' . $contrato_estado . ')"><span class="label label-pill label-danger">No Asociado</span></a>';
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