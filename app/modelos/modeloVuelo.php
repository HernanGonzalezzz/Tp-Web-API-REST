<?php

require_once 'modelo.php';

class ModeloVuelo extends Modelo{

    public function existe($id){
        $consulta = $this->db->prepare("SELECT EXISTS( SELECT 1 FROM `vuelos` WHERE `id` = ? )");
        $consulta->execute([$id]);

        $existe = $consulta->fetchColumn();
        return $existe;
    }

    public function obtenerVuelos($filtro = null, $asc = false){
        $sql = "SELECT * FROM `vuelos` ";
        
        if($filtro){
            switch($filtro){
                case 'salida':
                    $sql .= ' ORDER BY `salida`';
                    break;
                case 'destino':
                    $sql .= ' ORDER BY `destino`';
                    break;
                case 'avion':
                    $sql .= ' ORDER BY `avion`';
                    break;
                case 'fecha':
                    $sql .= ' ORDER BY `fecha`';
                    break;
                case 'precio':
                    $sql .= ' ORDER BY `precio`';
                    break;
                case 'capacidad':
                    $sql .= ' ORDER BY `capacidad`';
                    break;
            }
                
            if ($asc) { 
                $sql .= " ASC;"; 
            } else {
                $sql .= " DESC;"; 
            }
        }
        
        $consulta = $this->db->prepare($sql);
        $consulta->execute();
        $vuelos = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $vuelos;
    }

    function obtenerVuelo($id){
        $consulta = $this->db->prepare("SELECT * FROM `vuelos` WHERE `id` = ?");
        $consulta->execute([$id]);
        return $consulta->fetch(PDO::FETCH_OBJ);
    }


    function agregarVuelo($salida, $destino, $avion, $hsSalida, $hsLlegada, $fecha, $precio, $capacidad, $url){
        $consulta = $this->db->prepare("INSERT INTO `vuelos`(`salida`, `destino`, `avion`, `hs_salida`, `hs_llegada`, `fecha`, `precio`, `capacidad`, `url_Imagen`) VALUES (?,?,?,?,?,?,?,?,?)");
        $consulta->execute([$salida, $destino, $avion, $hsSalida, $hsLlegada, $fecha, $precio, $capacidad, $url]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }

    
    function eliminarVuelo($id){
        $consulta = $this->db->prepare("DELETE FROM `vuelos` WHERE `id` = ?");
        $consulta->execute([$id]);
    }

    function modificarVuelo($salida,$destino,$avion,$hs_salida,$hs_llegada,$fecha,$precio,$capacidad, $url_Imagen,$id){
        $consulta = $this->db->prepare("UPDATE `vuelos` SET `salida`=?,`destino`=?,`avion`=?,`hs_salida`=?,`hs_llegada`=?,`fecha`=?,`precio`=?,`capacidad`=?, `url_Imagen`=? WHERE `id`=?");
        $consulta->execute([$salida,$destino,$avion,$hs_salida,$hs_llegada,$fecha,$precio,$capacidad, $url_Imagen,$id]);
    }

    function insertarVuelo($salida,$destino,$avion,$hs_salida,$hs_llegada,$fecha,$precio,$capacidad, $url_Imagen){
        $consulta = $this->db->prepare("INSERT INTO `vuelos`(`salida`, `destino`, `avion`, `hs_salida`, `hs_llegada`, `fecha`, `precio`, `capacidad`, `url_Imagen`) VALUES (?,?,?,?,?,?,?,?,?)");
        $consulta->execute([$salida,$destino,$avion,$hs_salida,$hs_llegada,$fecha,$precio,$capacidad, $url_Imagen]);
    }
    
}