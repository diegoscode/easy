<?php
    require_once("../config/conexion.php");
    require_once("../models/Contrato.php");
    $contrato = new Contrato();

    switch($_GET["op"]){
        case "insert":
            $contrato->insert_contrat($_POST["usu_id"],$_POST["nom_emp"],$_POST["descrip_contrat"],$_POST["tip_serv"],$_POST["cost_serv"],$_POST["contrat_est"]);
        break;

        case "listar_x_client":
            $datos=$contrato->listar_contrat_x_client($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["contrat_id"];
                $sub_array[] = $row["nom_emp"];
                $sub_array[] = $row["descrip_contrat"];
                $sub_array[] = $row["tip_serv"];
                $sub_array[] = $row["cost_serv"];

                $contrat_estado;

            if ($row["contrat_est"] == "Abierto") {
                $contrat_estado = "'" . 'Cerrado' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["contrat_id"] . ',' . $contrat_estado . ')"><span class="label label-pill label-success">Disponible</span></a>';
            } else {
                $contrat_estado = "'" . 'Abierto' . "'";
                $sub_array[] = '<a onClick="CambiarEstado(' . $row["contrat_id"] . ',' . $contrat_estado . ')"><span class="label label-pill label-danger">Cerrado</span></a>';
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
            $contrato->cambiar_estado($_POST["contrat_id"], $_POST["estado"]);
            break;
            
    }
?>