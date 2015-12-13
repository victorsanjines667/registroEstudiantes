<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Direccion
 *
 * @author Linder
 */
include_once "../librerias/BDPG.class.php";

class Direccion extends BDPG{
    //put your code here
    private $id;
    private $descripcion;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getListaDireccion(){
        $sql = "select * from direccion";
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        if ($this->filasAfectadas($consulta) > 0) {
            while ($listadatos = $this->listaDatos($consulta)) {
                $datos[] = $listadatos;
            }
            return $datos;
        } else {
            return '[]';
        }
        $this->desconexionDB();
    }
}

?>
