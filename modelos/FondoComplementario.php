<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FondoComplementario
 *
 * @author Linder
 */
include_once "../librerias/BDPG.class.php";

class FondoComplementario extends BDPG{
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
    
    public function getListaFondoComplementario(){
        $sql = "select * from fondocomplementario";
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        $optionsFC = "<option value='-1'>Seleccione un Fondo Complementario</option>";
        if ($this->filasAfectadas($consulta) > 0) {
            while ($listadatos = $this->listaDatos($consulta)) {
                $optionsFC.= "<option value='" . $listadatos["id"] . "'>" . $listadatos["descripcion"] . "</option>";
                //$datos[] = $listadatos;
            }
            return $optionsFC;
        } else {
            return $optionsFC;
        }
        $this->desconexionDB();
    }
	public function getDatosFondoComplementario($idFondoComplementario){
        $sql = "SELECT fc.id, fc.descripcion
				FROM fondocomplementario fc 
                where fc.id=".$idFondoComplementario;
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        if($this->filasAfectadas($consulta)>0){
            $fondocomplementario = new FondoComplementario();
            while($listadatos = $this->listaDatos($consulta)){
                $fondocomplementario->setId($listadatos["id"]);
                $fondocomplementario->setDescripcion($listadatos["descripcion"]);
              
            }
            return $fondocomplementario;
        }else{
            return null;
        }
        $this->desconexionDB();
    }
}

?>
