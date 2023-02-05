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