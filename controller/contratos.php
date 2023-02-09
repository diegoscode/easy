<?php
require_once("../config/conexion.php");
require_once("../models/Contratos.php");
require_once("../vendor/autoload.php");

$contratos = new Contratos();
use Dompdf\Dompdf;

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
                . '<button type="button" class="btn btn-sm btn-secondary" onClick="imprimir(' . $row["contrat_id_raw"] . ')" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'

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

    case "imprimir":
        $contrato = $_POST['contrato'];

        $serviciosJson = json_decode($contrato['servicios'], true);
        $contratoPlanJson = json_decode($contrato['contrato_plan'], true);

        $nombre = $contrato['nom_emp'];
        $cedula = $contrato['cedula'];
        $contratoTipo = $contratoPlanJson['plan'];
        $horario = $contratoPlanJson['horario'];
        $monto = $contrato['cost_serv'];
        $fecha = $contrato['fech_contrat'];
        $currentYear = date("Y");

        $servicios = '';

        foreach ($serviciosJson as $servicio) {
            $servicios .= $servicio['tip_serv'] . ' ,';
        }

        $estilos = '<style>.bottom-line {
            border-bottom: 1px solid black;
            padding-bottom: 1px;
        }</style>';

        $html = $estilos . '
        <header>
        <h1 id="titulo">CONTRATO</h1>
    </header>
    <div>
        <p>Fecha de contrato <span class="bottom-line">' . $fecha . '</span></p>
    </div>
    <section>
        <article class="post">
            <h2>CONFORMIDAD</h2>
            <p> Para <span class="bottom-line">' . $nombre . '</span> , con C.I. o RIF numero <span class="bottom-line">' . $cedula . '</span> , quien ahora dispone de un contrato de tipo <span class="bottom-line">' . $contratoTipo . '</span>, cuyo horario semanal sera de <span class="bottom-line">' . $horario . '</span> , por lo tanto la validez del contrato comenzara a partir de la fecha estipulada  </p>
        <article class="post">
            <p>Primero. – Objeto del presente contrato
                La EMPRESA prestará al CLIENTE servicios sobre las siguientes materias, lo que se concreta en la realización de los siguientes trabajos o servicios: <span class="bottom-line">' . $servicios . '</span> con un costo total de <span class="bottom-line">' . $monto . '</span>
            </p>
        </article>
    </section>
    <footer>
        <p>Smartech. Copyright ' . $currentYear . '</p>
    </footer>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $pdf = $dompdf->output();
        $nombre_archivo = 'contrato.pdf';

        file_put_contents('contrato.pdf', $pdf);

        $data['nombre_archivo'] = $nombre_archivo;

        echo json_encode($data);


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

    case "total";
        $datos = $contratos->get_contratos_total();
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["TOTAL"] = $row["TOTAL"];
            }
            echo json_encode($output);
        }
        break;

}
?>