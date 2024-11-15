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
        $filtroPor = null;

        if(!empty($req->query->filtroPor)){
            $filtroPor = $req->query->filtroPor;
        }

        $vuelos = $this->modeloVuelo->obtenerVuelos($filtroPor);
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
            return $respuesta;
        }

        $salida = $req->body->salida;
        $destino = $req->body->destino;
        $avion = $req->body->avion;
        $hsSalida = $req->body->hs_salida;
        $hsLlegada = $req->body->hs_llegada;
        $fecha = $req->body->fecha;
        $precio = $req->body->precio;
        $capacidad = $req->body->capacidad;
        $url = $req->body->url_Imagen;

        $id = $this->modeloVuelo->agregarVuelo($salida, $destino, $avion, $hsSalida, $hsLlegada, $fecha, $precio, $capacidad, $url);
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

        $respuesta = $this->comprobarDatos($req); //compruebo que esten todos los datos
        if($respuesta != null){
            return $respuesta;
        }
        
        $salida = $req->body->salida;
        $destino = $req->body->destino;
        $avion = $req->body->avion;
        $hs_salida = $req->body->hs_salida;
        $hs_llegada = $req->body->hs_llegada;
        $fecha = $req->body->fecha;
        $precio = $req->body->precio;
        $capacidad = $req->body->capacidad;
        $url = $req->body->url_Imagen;

        $this->modeloVuelo->modificarVuelo($salida,$destino,$avion,$hs_salida,$hs_llegada,$fecha,$precio,$capacidad, $url,$id);

        $vuelo = $this->modeloVuelo->obtenerVuelo($id);
        return $this->vista->response($vuelo); //retorno el vuelo que modifique
    }
 
    private function comprobarDatos($req){
        if(empty($req->body->salida)){
            return $this->vista->response("Falta la salida", 400);
        }
        if(empty($req->body->destino)){
            return $this->vista->response("Falta el destino", 400);
        }
        if(empty($req->body->avion)){
            return $this->vista->response("Falta el avion", 400);
        }
        if(empty($req->body->hs_salida)){
            return $this->vista->response("Falta la hs de salida", 400);
        }
        if(empty($req->body->hs_llegada)){
            return $this->vista->response("Falta la hs de llegada", 400);
        }
        if(empty($req->body->fecha)){
            return $this->vista->response("Falta la fecha", 400);
        }
        if(empty($req->body->precio)){
            return $this->vista->response("Falta el precio", 400);
        }
        if(empty($req->body->capacidad)){
            return $this->vista->response("Falta la capacidad", 400);
        }
        if(empty($req->body->url_Imagen)){
            return $this->vista->response("Falta la imagen", 400);
        }
        return null;
    }
}