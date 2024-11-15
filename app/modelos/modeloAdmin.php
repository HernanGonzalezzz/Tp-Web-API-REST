<?php

require_once 'modelo.php';

class ModeloAdmin extends Modelo{


    public function obtenerUsuarioConEmail($email){
        $consulta = $this->db->prepare("SELECT * FROM `administrador` WHERE `email` = ?");
        $consulta->execute([$email]);

        $usuario = $consulta->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }
}