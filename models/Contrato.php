<?php
    class Contrato extends Conectar{

        public function insert_contrat($usu_id,$nom_emp,$descrip_contrat,$tip_serv,$cost_serv){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO contrato (contrat_id, usu_id, nom_emp, descrip_contrat, tip_serv, cost_serv, contrat_est, est) VALUES (NULL,?,?,?,?,?,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $nom_emp);
            $sql->bindValue(3, $descrip_contrat);
            $sql->bindValue(4, $tip_serv);
            $sql->bindValue(5, $cost_serv);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>