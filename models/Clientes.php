<?php
class Clientes extends Conectar
{
    public function insert_cliente($nom_emp, $cedula, $tip_per)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO clientes (client_id, nom_emp, cedula, tip_per, client_est, est) VALUES (NULL, ?, ?, ?, 'Activo', '1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nom_emp);
        $sql->bindValue(2, $cedula);
        $sql->bindValue(3, $tip_per);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_cliente()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM clientes where est='1';";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_cliente($client_id, $nom_emp, $cedula, $tip_per)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE clientes set
                nom_emp = ?,
                cedula = ?,
                tip_per = ?,
                WHERE
                client_id = ? and est='1';";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nom_emp);
        $sql->bindValue(2, $cedula);
        $sql->bindValue(3, $tip_per);
        $sql->bindValue(4, $client_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_cliente($client_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE clientes 
            SET 
                est='0'
            where client_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $client_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_cliente_x_usu()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM clientes where est=1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function cambiar_estado($client_id, $client_est)
    {
        $this->console_log($client_id);
        $this->console_log($client_est);
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE clientes 
        SET 
            client_est=?
        where client_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $client_est);
        $sql->bindValue(2, $client_id);
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