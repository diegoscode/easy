<?php
    class Categoria extends Conectar{

        public function get_categoria(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM categoria_pagos WHERE est=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_categoria_ticket(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM categoria_ticket WHERE est=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>