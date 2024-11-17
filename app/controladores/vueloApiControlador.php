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
        $asc = false;
        
        if(!empty($req->query->filtroPor)){
            $filtroPor = $req->query->filtroPor;
        }
        if(!empty($req->query->asc)){
            $asc = filter_var($req->query->asc, FILTER_VALIDATE_BOOLEAN);//convierto el valor en booleano
        }

        $vuelos = $this->modeloVuelo->obtenerVuelos($filtroPor, $asc);
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

        $salida = $vuelo->salida;
        $destino = $vuelo->destino;
        $avion = $vuelo->avion;
        $hs_salida = $vuelo->hs_salida;
        $hs_llegada = $vuelo->hs_llegada;
        $fecha = $vuelo->fecha;
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
        if(isset($req->body->hs_salida) && !empty($req->body->hs_salida)){
            $hs_salida = $req->body->hs_salida;
        }
        if(isset($req->body->hs_llegada) && !empty($req->body->hs_llegada)){
            $hs_llegada = $req->body->hs_llegada;
        }
        if(isset($req->body->fecha) && !empty($req->body->fecha)){
            $fecha = $req->body->fecha;
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
        

        $this->modeloVuelo->modificarVuelo($salida,$destino,$avion,$hs_salida,$hs_llegada,$fecha,$precio,$capacidad, $url,$id);

        $vuelo = $this->modeloVuelo->obtenerVuelo($id);
        return $this->vista->response($vuelo); //retorno el vuelo que modifique
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
        if(empty($req->body->hs_salida)){
            return "Falta la hs de salida";
        }
        if(empty($req->body->hs_llegada)){
            return "Falta la hs de llegada";
        }
        if(empty($req->body->fecha)){
            return "Falta la fecha";
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