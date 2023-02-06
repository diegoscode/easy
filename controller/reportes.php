<?php
require_once("../config/conexion.php");
require_once("../models/Reportes.php");

$reportes = new Reportes();

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


    case 'listar':

        $datos = $reportes->listarReportes($_SESSION['rol_id'], $_SESSION['usu_id']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["codigo_report"];
            $sub_array[] = $row["tip_pag"];
            $sub_array[] = $row["origen"];
            $sub_array[] = $row["fech_trans"];
            $sub_array[] = $row["monto"];

            $comprobante = "'" . '../' . $row['comprobante'] . "'";
            $sub_array[] = '<button onClick="abrirModalImagen(' . $comprobante . ')" class="btn btn-sm btn-light">Ver Comprobante</button>';

            $reporte_estado;

            if ($row["report_est"] == "Esperando") {
                $servicio_estado = "'" . 'Finalizado' . "'";
                if ($_SESSION['rol_id'] == 2) {
                    $sub_array[] = '<a onClick="CambiarEstado(' . $row["report_id"] . ',' . $servicio_estado . ')"><span class="label label-pill label-warning">Esperando</span></a>';
                } else {
                    $sub_array[] = '<span class="label label-pill label-success">Esperando</span>';
                }

            } else {
                $servicio_estado = "'" . 'Esperando' . "'";

                if ($_SESSION['rol_id'] == 2) {
                    $sub_array[] = '<a onClick="CambiarEstado(' . $row["report_id"] . ',' . $servicio_estado . ')"><span class="label label-pill label-success">Finalizado</span></a>';
                } else {
                    $sub_array[] = '<span class="label label-pill label-success">Finalizado</span>';
                }
            }

            $sub_array[] = '<button onClick="imprimir(' . $row['report_id'] . ')" class="btn btn-secondary btn-sm">imprimir</button>';

            if ($_SESSION['rol_id'] == 2) {
                $sub_array[] = '<button type="button" onClick="eliminar(' . $row["num_serv"] . ')"  id="' . $row["num_serv"] . '" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $sub_array[] = '<button type="button" onClick="editar(' . $row["num_serv"] . ')"  id="' . $row["num_serv"] . '" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
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

    case 'buscar':

        $datos = $reportes->encontrarReporte($_POST['report_id']);

        echo json_encode($datos);

        break;


    case 'insert':

        $nombreDeArchivo = $_SESSION['usu_id'] . '-' . $_POST['numero_referencia'] . '-' . $_POST['fech_trans'];
        $ruta = "../public/document/" . $nombreDeArchivo . "/";

        $destino = null;

        if (!empty($_FILES['comprobante']['name'])) {
            if (!file_exists($ruta)) {
                mkdir($ruta, 0777, true);
            }

            $doc1 = $_FILES['comprobante']['tmp_name'];
            $destino = $ruta . $_FILES['comprobante']['name'];

            move_uploaded_file($doc1, $destino);

        }

        $telefono = null;

        if (isset($_POST['telefono'])) {
            $telefono = $_POST['telefono'];
        }

        $resultado = $reportes->insert_reporte($_SESSION['usu_id'], $_POST['numero_referencia'], $_POST['tip_pag'], $_POST['origen'], $telefono, $destino, $_POST['monto'], $_POST['fech_trans']);

        echo json_encode($resultado);
        break;

}