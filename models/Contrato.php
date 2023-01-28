<?php
class Contrato extends Conectar
{

    public function insert_contrat($usu_id, $nom_emp, $descrip_contrat, $tip_serv, $cost_serv, $contrat_est)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO contrato (contrat_id,usu_id,nom_emp,descrip_contrat,tip_serv,cost_serv,contrat_est,est) VALUES (NULL,?,?,?,?,?,'Abierto','1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $nom_emp);
        $sql->bindValue(3, $descrip_contrat);
        $sql->bindValue(4, $tip_serv);
        $sql->bindValue(5, $cost_serv);
        // $sql->bindValue(6, $contrat_est);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function listar_contrat_x_client($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
                contrato.contrat_id,
                contrato.usu_id,
                contrato.nom_emp,
                contrato.descrip_contrat,
                contrato.tip_serv,
                contrato.cost_serv,
                contrato.contrat_est,
                usuarios.usu_nom,
                usuarios.usu_ape
                FROM 
                contrato
                INNER join usuarios on contrato.usu_id = usuarios.usu_id
                WHERE
                contrato.est = 1
                AND usuarios.usu_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


}
?>