<?php
    require_once("../config/conexion.php");
    require_once("../models/Contrato.php");
    $contrato = new Contrato();

    switch($_GET["op"]){
        case "insert":
            $contrato->insert_contrat($_POST["usu_id"],$_POST["nom_emp"],$_POST["descrip_contrat"],$_POST["tip_serv"],$_POST["cost_serv"]);
        break;
    }
?>