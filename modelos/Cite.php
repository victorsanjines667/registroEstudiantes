<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cite
 *
 * @author Linder
 */
include_once "../librerias/BDPG.class.php";

class Cite extends BDPG{
    //put your code here
    private $id;
    private $cite;
    private $fecha;
    private $idTipoCite;
    private $idFuncionario;
    private $gestion;
    private $eliminado;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCite() {
        return $this->cite;
    }

    public function setCite($cite) {
        $this->cite = $cite;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getIdTipoCite() {
        return $this->idTipoCite;
    }

    public function setIdTipoCite($idTipoCite) {
        $this->idTipoCite = $idTipoCite;
    }

    public function getIdFuncionario() {
        return $this->idFuncionario;
    }

    public function setIdFuncionario($idFuncionario) {
        $this->idFuncionario = $idFuncionario;
    }

    public function getGestion() {
        return $this->gestion;
    }

    public function setGestion($gestion) {
        $this->gestion = $gestion;
    }

    public function getEliminado() {
        return $this->eliminado;
    }

    public function setEliminado($eliminado) {
        $this->eliminado = $eliminado;
    }
	
	public function getDatosCite($idCite){
        $sql = "SELECT ci.id, ci.cite, ci.fecha, ci.idtipocite, ci.idfuncionario
				FROM cite ci 
                where ci.id=".$idCite;
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        if($this->filasAfectadas($consulta)>0){
            $cite = new Cite();
            while($listadatos = $this->listaDatos($consulta)){
                $cite->setId($listadatos["id"]);
                $cite->setCite($listadatos["cite"]);
                $cite->setFecha($listadatos["fecha"]);
                $cite->setIdTipoCite($listadatos["idtipocite"]);
				$cite->setIdFuncionario($listadatos["idfuncionario"]);

            }
            return $cite;
        }else{
            return null;
        }
        $this->desconexionDB();
    }

}

?>
