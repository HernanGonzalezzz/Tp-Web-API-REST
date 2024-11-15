<?php

require_once 'modelo.php';

class ModeloUsuario extends Modelo{

    public function existe($id){
        $consulta = $this->db->prepare("SELECT EXISTS( SELECT 1 FROM `usuarios` WHERE `id` = ? )");
        $consulta->execute([$id]);

        $existe = $consulta->fetchColumn();
        return $existe;
    }
    public function existeEmail($email){
        $consulta = $this->db->prepare("SELECT EXISTS( SELECT 1 FROM `usuarios` WHERE `email` = ? )");
        $consulta->execute([$email]);

        $existe = $consulta->fetchColumn();
        return $existe;
    }

    public function obtenerUsuario($id){
        $consulta = $this->db->prepare("SELECT * FROM `usuarios` WHERE `id` = ?");
        $consulta->execute([$id]);

        $usuario = $consulta->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }

    public function obtenerUsuarios(){
        $consulta = $this->db->prepare("SELECT * FROM `usuarios`");
        $consulta->execute();

        $usuario = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $usuario;
    }

    public function obtenerUsuariosConVuelo($id_vuelo){
        $consulta = $this->db->prepare("SELECT * FROM `usuarios` WHERE `id_vuelo`= ?");
        $consulta->execute([$id_vuelo]);

        $usuarios = $consulta->fetchall(PDO::FETCH_OBJ);
        return $usuarios;
    }
    
    public function obtenerUsuarioConEmail($email){
        $consulta = $this->db->prepare("SELECT * FROM `usuarios` WHERE `email`= ?");
        $consulta->execute([$email]);

        $usuario = $consulta->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }

    function agregarUsuario($nombre,$apellido,$email){
        $consulta = $this->db->prepare("INSERT INTO `usuarios`( `nombre`, `apellido`, `email`, `id_vuelo`) VALUES (?,?,?, null)");
        $consulta->execute([$nombre,$apellido,$email]);
    }

    public function modificarUsuario($nombre, $apellido, $email, $id_vuelo, $id){
        $consulta = $this->db->prepare("UPDATE `usuarios` SET `nombre`=?,`apellido`=?,`email`=?,`id_vuelo`=? WHERE `id`=?");
        $consulta->execute([$nombre, $apellido, $email, $id_vuelo, $id]);
    }

    
    public function eliminarVuelo($id){
        $consulta = $this->db->prepare("UPDATE `usuarios` SET `id_vuelo`=null WHERE `id`=?");
        $consulta->execute([$id]);
    }


    function eliminarUsuario($id){
        $consulta = $this->db->prepare("DELETE FROM `usuarios` WHERE `id` = ?");
        $consulta->execute([$id]);
    }
}