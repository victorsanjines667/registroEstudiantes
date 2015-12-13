<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoPrestamo
 *
 * @author Linder
 */
include_once "../librerias/BDPG.class.php";

class TipoPrestamo extends BDPG{
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

    public function getListaTipoPrestamo(){
        $sql = "select * from tipoprestamo";
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        $optionsTipoPrestamo = "<option value='-1'>Seleccione un Tipo Préstamo</option>";
        if ($this->filasAfectadas($consulta) > 0) {
            while ($listadatos = $this->listaDatos($consulta)) {
                $optionsTipoPrestamo.= "<option value='" . $listadatos["id"] . "'>" . $listadatos["descripcion"] . "</option>";
                //$datos[] = $listadatos;
            }
            return $optionsTipoPrestamo;
        } else {
            return $optionsTipoPrestamo;
        }
        $this->desconexionDB();
    }
}

?>
