<?php
class Contratos extends Conectar
{

    public function insert_contratos($usu_id, $nom_emp, $descrip_contrat, $tip_serv, $cost_serv, $contrat_est)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO contratos (contrat_id,usu_id,nom_emp,descrip_contrat,tip_serv,cost_serv,contrat_est,est) VALUES (NULL,?,?,?,?,?,'Abierto','1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $nom_emp);
        $sql->bindValue(3, $descrip_contrat);
        $sql->bindValue(4, $tip_serv);
        $sql->bindValue(5, $cost_serv);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function listar_contratos_x_clientes($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
                contratos.contrat_id,
                contratos.usu_id,
                contratos.nom_emp,
                contratos.descrip_contrat,
                contratos.tip_serv,
                contratos.cost_serv,
                contratos.contrat_est,
                usuarios.usu_nom,
                usuarios.usu_ape
                FROM 
                contratos
                INNER join usuarios on contratos.usu_id = usuarios.usu_id
                WHERE
                contratos.est = 1
                AND usuarios.usu_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function cambiar_estado($contrat_id, $contrat_est)
    {
        $this->console_log($contrat_id);
        $this->console_log($contrat_est);
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE contratos 
        SET 
            contrat_est=?
        where contrat_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $contrat_est);
        $sql->bindValue(2, $contrat_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();

    }

    function console_log($output, $with_script_tags = true)
    {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
            ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }


}
?>