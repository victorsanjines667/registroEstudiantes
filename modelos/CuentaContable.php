<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CuentaContable
 *
 * @author Linder
 */
include_once "../librerias/BDPG.class.php";

class CuentaContable extends BDPG{
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
    
    public function getListaCuentaContable(){
        $sql = "select * from cuentacontable";
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        $optionsCC = "<option value='-1'>Seleccione una Cuenta Contable</option>";
        if ($this->filasAfectadas($consulta) > 0) {
            while ($listadatos = $this->listaDatos($consulta)) {
                $optionsCC.= "<option value='" . $listadatos["id"] . "'>" . $listadatos["descripcion"] . "</option>";
                //$datos[] = $listadatos;
            }
            return $optionsCC;
        } else {
            return $optionsCC;
        }
        $this->desconexionDB();
    }
	public function getDatosCuentaContable($idCuentaContable){
        $sql = "SELECT cc.id, cc.descripcion
				FROM cuentacontable cc 
                where cc.id=".$idCuentaContable;
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        if($this->filasAfectadas($consulta)>0){
            $cuentacontable = new CuentaContable();
            while($listadatos = $this->listaDatos($consulta)){
                $cuentacontable->setId($listadatos["id"]);
                $cuentacontable->setDescripcion($listadatos["descripcion"]);
              
            }
            return $cuentacontable;
        }else{
            return null;
        }
        $this->desconexionDB();
    }
}

?>
