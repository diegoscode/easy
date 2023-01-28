<?php 
    class Servicios extends Conectar{
        public function insert_servicio($num_serv,$cod_serv,$tip_serv,$cat_id,$sub_cat,$precio,$serv_est){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO servicios (num_serv, cod_serv, tip_serv, cat_id, sub_cat, precio, serv_est, est) VALUES (NULL, ?, ?, ?, ?, ?, 'Disponible', '1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $num_serv);
            $sql->bindValue(2, $cod_serv);
            $sql->bindValue(3, $tip_serv);
            $sql->bindValue(4, $cat_id);
            $sql->bindValue(5, $sub_cat);
            $sql->bindValue(5, $precio);
            $sql->bindValue(7, $serv_est);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_servicio(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM servicios where est='1';";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_servicio($num_serv,$cod_serv,$tip_serv,$cat_id,$sub_cat,$precio){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE servicios set
                tip_serv = ?,
                cat_id = ?,
                sub_cat = ?,
                precio = ?
                WHERE
                num_serv = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tip_serv);
            $sql->bindValue(2, $cat_id);
            $sql->bindValue(3, $sub_cat);
            $sql->bindValue(4, $precio);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_servicio($num_serv){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE servicios 
            SET 
                est='0'
            where num_serv=xnum_serv;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $num_serv);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_servicio_x_usu(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM servicios where est=1 and rol_id=2";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }

?>