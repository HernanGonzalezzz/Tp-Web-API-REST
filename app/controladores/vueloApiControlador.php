<?php

require_once './app/modelos/modeloVuelo.php';
require_once './app/modelos/modeloUsuario.php';
require_once './app/vista/vista.php';

class VueloControlador{
    private $modeloVuelo;
    private $modeloUsuario;
    private $vista;

    function __construct(){
        $this->modeloVuelo = new ModeloVuelo();
        $this->modeloUsuario = new ModeloUsuario();
        $this->vista = new Vista();
    }

    function obtenerTodo($req, $res){
        $clasificar = null;
        $order = null;
        
        if(!empty($req->query->clasificar)){
            $clasificar = $req->query->clasificar;
        }
        if(!empty($req->query->order)){
            $order = $req->query->order;
        }

        $vuelos = $this->modeloVuelo->obtenerVuelos($clasificar, $order);
        return $this->vista->response($vuelos, 200);
    }

    function obtener($req, $res){
        $id = $req->params->id;

        $vuelo = $this->modeloVuelo->obtenerVuelo($id);
        if(!$vuelo){
            return $this->vista->response("El vuelo con el id=$id no existe", 404);
        }

        return $this->vista->response($vuelo, 200);
    }

    function agregar($req, $res){
        $respuesta = $this->comprobarDatos($req); //compruebo que esten todos los datos
        if($respuesta != null){
            return $this->vista->response($respuesta, 400);
        }

        $salida = $req->body->salida;
        $destino = $req->body->destino;
        $avion = $req->body->avion;
        $fechaSalida = $req->body->fecha_salida;
        $fechaLlegada = $req->body->fecha_llegada;
        $precio = $req->body->precio;
        $capacidad = $req->body->capacidad;
        $url = $req->body->url_Imagen;

        $id = $this->modeloVuelo->agregarVuelo($salida, $destino, $avion, $fechaSalida, $fechaLlegada, $precio, $capacidad, $url);
        if(!$id){
            return $this->vista->response("El vuelo no se pudo agregar", 500);
        }
        $vuelo = $this->modeloVuelo->obtenerVuelo($id);
        return $this->vista->response($vuelo, 201);
    }

    function modificar($req, $res){
        $id = $req->params->id;

        $vuelo = $this->modeloVuelo->obtenerVuelo($id);
        if(!$vuelo){
            return $this->vista->response("El vuelo con id=$id no existe", 404);
        }

        $salida = $vuelo->salida;
        $destino = $vuelo->destino;
        $avion = $vuelo->avion;
        $fechaSalida = $req->body->fecha_salida;
        $fechaLlegada = $req->body->fecha_llegada;
        $precio = $vuelo->precio;
        $capacidad = $vuelo->capacidad;
        $url = $vuelo->url_Imagen;

        if(isset($req->body->salida) && !empty($req->body->salida)){
            $salida = $req->body->salida;
        }
        if(isset($req->body->destino) && !empty($req->body->destino)){
            $destino = $req->body->destino;
        }
        if(isset($req->body->avion) && !empty($req->body->avion)){
            $avion = $req->body->avion;
        }
        if(isset($req->body->fecha_salida) && !empty($req->body->fecha_salida)){
            $fechaSalida = $req->body->fecha_salida;
        }
        if(isset($req->body->fecha_llegada) && !empty($req->body->fecha_llegada)){
            $fechaLlegada = $req->body->fecha_llegada;
        }
        if(isset($req->body->precio) && !empty($req->body->precio)){
            $precio = $req->body->precio;
        }
        if(isset($req->body->capacidad) && !empty($req->body->capacidad)){
            $capacidad = $req->body->capacidad;
        }
        if(isset($req->body->url_Imagen) && !empty($req->body->url_Imagen)){
            $url = $req->body->url_Imagen;
        }
        

        $this->modeloVuelo->modificarVuelo($salida,$destino,$avion,$fechaSalida,$fechaLlegada,$precio,$capacidad, $url,$id);

        $vuelo = $this->modeloVuelo->obtenerVuelo($id);
        return $this->vista->response($vuelo); //retorno el vuelo que modifique
    }
 
    public function eliminar($req, $res){
        $id = $req->params->id;

        $vuelo = $this->modeloVuelo->obtenerVuelo($id);
        if(!$vuelo){
            return $this->vista->response("El vuelo con id=$id no existe", 404);
        }

        $this->modeloVuelo->eliminarVuelo($id);

        return $this->vista->response("El vuelo con id=$id fue eliminado");
    }

    private function comprobarDatos($req){
        if(empty($req->body->salida)){
            return "Falta la salida";
        }
        if(empty($req->body->destino)){
            return "Falta el destino";
        }
        if(empty($req->body->avion)){
            return "Falta el avion";
        }
        if(empty($req->body->fecha_salida)){
            return "Falta la fecha de salida";
        }
        if(empty($req->body->fecha_llegada)){
            return "Falta la fecha de llegada";
        }
        if(empty($req->body->precio)){
            return "Falta el precio";
        }
        if(empty($req->body->capacidad)){
            return "Falta la capacidad";
        }
        if(empty($req->body->url_Imagen)){
            return "Falta la imagen";
        }
        return null;
    }
}