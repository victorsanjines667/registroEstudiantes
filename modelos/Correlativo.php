<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Correlativo
 *
 * @author Linder
 */
class Correlativo {
    //put your code here
    private $id;
    private $numero;
    private $idTipoCite;
    private $gestion;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getIdTipoCite() {
        return $this->idTipoCite;
    }

    public function setIdTipoCite($idTipoCite) {
        $this->idTipoCite = $idTipoCite;
    }

    public function getGestion() {
        return $this->gestion;
    }

    public function setGestion($gestion) {
        $this->gestion = $gestion;
    }
    
    public function sacarCorrelativo(){
        
    }
}

?>
