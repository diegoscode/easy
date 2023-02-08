<?php
require_once("../config/conexion.php");
require_once("../models/Reportes.php");
require_once("../vendor/autoload.php");

use Dompdf\Dompdf;

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
            if ($_SESSION['rol_id'] == 2) {
                $sub_array[] = $row["nombre"];
                $sub_array[] = $row["cedula"];
            }

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
                $sub_array[] = '<div class="btn-group" role="group">'
                    . '<button type="button" class="btn btn-sm btn-primary" onclick="editar(10)"><i class="fa fa-edit"></i></button>'
                    . '<button type="button" class="btn btn-sm btn-danger" onclick="eliminar(10)"><i class="fa fa-trash"></i></button>'
                    . '</div>';
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

    case 'imprimir':
        $reporte = $_POST['reporte'];

        $codigo_report = $reporte['codigo_report'];
        $fech_trans = $reporte['fech_trans'];
        $monto = $reporte['monto'];
        $tip_pag = $reporte['tip_pag'];
        $telefono = isset($reporte['telefono']) && !empty($reporte['telefono']);
        $currentYear = date("Y");
        $telefonoHTML = $telefono ? 
            '<li>
        <span class="label">telefono</span>
        <span class="value">' . $reporte['telefono'] . '</span> 
        </li>' : '';


        $estilos = '<style>
        .recibo {
            max-width: 550px;
        }

        .recibo h1 {
            padding-bottom: 20px;
            border-bottom: 10px solid black;
            text-transform: uppercase;
            display: block;
            font-weight: 500;
        }

        .recibo table {
            width: 100%;
        }

        .recibo ul {
          padding: 0;
        }

        .recibo ul li {
            list-style: none;
            font-size: 22px;
            font-weight: 600;
            text-transform: uppercase;
            padding-bottom: 10px;
        }

        .recibo .label, 
        .recibo .value {
            display: inline-block;
        }

        .recibo .label {
            border-bottom: grey solid 5px;
            width: 50%;
        }

        .recibo .value {
              text-align: right;
              width: 49%;
              border-bottom: #ccc solid 5px;
        }

        .recibo .w-100 {
            width: 100%;
        }

        p {
        
            margin-top: -15px !important;
        }
    </style>';

        $html = $estilos . "<div class='recibo'>
        <h1>Recibo</h1>
        <ul>
          <li>
            <span class='label'>N°</span>
            <span class='value'>$codigo_report</span>
          </li>
          <li>
            <span class='label'>fecha</span>
            <span class='value'>$fech_trans</span>
          </li>
          <li>
            <span class='label'>importe total</span>
            <span class='value'>$monto</span>
          </li>
          " . $telefonoHTML . "
          <li>
            <span class='label w-100'>forma de pago</span>
          </li>
          <li>
            <span class='label'>$tip_pag</span>
            <span class='value'>$monto </span>
          </li>
        </ul>
              
        <p> Smartech. Todos los derechos reservados. $currentYear</p> 
        </div>";

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $pdf = $dompdf->output();
        $nombre_archivo = 'recibo.pdf';

        file_put_contents('recibo.pdf', $pdf);

        $data['nombre_archivo'] = $nombre_archivo;

        echo json_encode($data);

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