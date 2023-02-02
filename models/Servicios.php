<?php
class Servicios extends Conectar
{
    public function insert_servicios($tip_serv, $cat_serv, $sub_cat, $cost_serv)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO servicios (num_serv, tip_serv, cat_serv, sub_cat, cost_serv, serv_est, est) VALUES (NULL, ?, ?, ?, ?, 'Disponible', '1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tip_serv);
        $sql->bindValue(2, $cat_serv);
        $sql->bindValue(3, $sub_cat);
        $sql->bindValue(4, $cost_serv);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_servicios()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM servicios where est='1';";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_servicios($num_serv, $tip_serv, $cat_serv, $sub_cat, $cost_serv)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE servicios set
                tip_serv = ?,
                cat_serv = ?,
                sub_cat = ?,
                cost_serv = ?
                WHERE
                num_serv = ? and est='1';";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tip_serv);
        $sql->bindValue(2, $cat_serv);
        $sql->bindValue(3, $sub_cat);
        $sql->bindValue(4, $cost_serv);
        $sql->bindValue(5, $num_serv);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_servicios($num_serv)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE servicios 
            SET 
                est='0'
            where num_serv=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $num_serv);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_servicios_x_id($num_serv)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM servicios where est=1 AND num_serv=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $num_serv);
        $sql->execute();
        return $resultado=$sql->fetch();
    }

    public function cambiar_estado($num_serv, $serv_est)
    {
        $this->console_log($num_serv);
        $this->console_log($serv_est);
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE servicios 
        SET 
            serv_est=?
        where num_serv=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $serv_est);
        $sql->bindValue(2, $num_serv);
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