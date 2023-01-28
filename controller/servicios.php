<?php 
    require_once("../config/conexion.php");
    require_once("../models/Servicios.php");
    $servicios = new Servicios();

    switch($_GET["op"]){
        case "guardaryeditar":
            if(empty($_POST["usu_id"])){       
                $servicios->insert_servicio($_POST["num_serv"],$_POST["cod_serv"],$_POST["tip_serv"],$_POST["cat_id"],$_POST["sub_cat"],$_POST["precio"],$_POST["serv_est"]);     
            }
            else {
                $servicios->update_servicio($_POST["num_serv"],$_POST["cod_serv"],$_POST["tip_serv"],$_POST["cat_id"],$_POST["sub_cat"],$_POST["precio"],$_POST["serv_est"]);
            }
            break;

        case "listar":
                $datos=$servicios->get_servicio($_POST["num_serv"]);
                $data= Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = $row["num_serv"];
                    $sub_array[] = $row["cod_serv"];
                    $sub_array[] = $row["tip_serv"];
                    $sub_array[] = $row["cat_id"];
                    $sub_array[] = $row["sub_cat"];
                    $sub_array[] = $row["precio"];
    
                    if($row["serv_est"]=="Abierto"){
                            $sub_array[] = '<span class="label label-pill label-success">Disponible</span>';
                    }else{
                            $sub_array[] = '<span class="label label-pill label-danger">Inhabilitado</span>';
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

            case "eliminar":
                    $servicios->delete_servicio($_POST["num_serv"]);
                break;

            case "mostrar";
                    $datos=$servicios->get_servicio_x_usu($_POST["num_serv"]);  
                    if(is_array($datos)==true and count($datos)>0){
                        foreach($datos as $row)
                        {
                            $output["tip_serv"] = $row["tip_serv"];
                            $output["cat_id"] = $row["cat_id"];
                            $output["sub_cat"] = $row["sub_cat"];
                            $output["precio"] = $row["precio"];
                        }
                        echo json_encode($output);
                    }   
                break;

        }


?>