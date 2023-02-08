<?php
class Clientes extends Conectar
{
    public function insert_clientes($nom_emp, $doc_nac, $tip_per, $direccion)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO clientes (client_id, usu_id, nom_emp, doc_nac, direccion, tip_per, client_est, est) VALUES (NULL, NULL, ?, ?, ?, ?, 'Activo', '1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nom_emp);
        $sql->bindValue(2, $doc_nac);
        $sql->bindValue(3, $direccion);
        $sql->bindValue(4, $tip_per);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_clientes()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM clientes where est='1';";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_clientes($client_id, $nom_emp, $doc_nac, $tip_per)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE clientes set
                nom_emp = ?,
                doc_nac = ?,
                tip_per = ?
                WHERE
                client_id = ? and est='1';";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nom_emp);
        $sql->bindValue(2, $doc_nac);
        $sql->bindValue(3, $tip_per);
        $sql->bindValue(4, $client_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_clientes($client_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM clientes WHERE client_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $client_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_clientes_x_id($client_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM clientes where est=1 AND client_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $client_id);
        $sql->execute();
        return $resultado = $sql->fetch();
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

    public function get_clientes_total(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT COUNT(*) as TOTAL FROM clientes";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

}

?>