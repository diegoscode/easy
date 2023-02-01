<?php
    require_once("../config/conexion.php");
    require_once("../models/Contratos.php");
    $contratos = new Contratos();

    switch($_GET["op"]){
        case "insert":
            $contratos->insert_contratos($_POST["usu_id"],$_POST["nom_emp"],$_POST["descrip_contrat"],$_POST["tip_serv"],$_POST["cost_serv"],$_POST["contrat_est"]);
        break;

        case "listar_x_client":
            $datos=$contratos->listar_contratos_x_clientes($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["contrat_id"];
                $sub_array[] = $row["nom_emp"];
                $sub_array[] = $row["descrip_contrat"];
                $sub_array[] = $row["tip_serv"];
                $sub_array[] = $row["cost_serv"];

                $contrato_estado;

            if ($row["contrat_est"] == "Abierto") {
                $contrato_estado = "'" . 'Cerrado' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["contrat_id"] . ',' . $contrato_estado . ')"><span class="label label-pill label-success">Disponible</span></a>';
            } else {
                $contrato_estado = "'" . 'Abierto' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["contrat_id"] . ',' . $contrato_estado . ')"><span class="label label-pill label-danger">Cerrado</span></a>';
                }

                $data[] = $sub_array;
            }
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
            break;

            case "cambiarestado";
            $contratos->cambiar_estado($_POST["contrat_id"], $_POST["estado"]);
            break;
            
    }
?>