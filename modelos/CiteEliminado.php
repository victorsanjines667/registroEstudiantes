<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CiteEliminado
 *
 * @author Linder
 */
class CiteEliminado {
    //put your code here
     private $id;
     private $idcite;
     private $motivo;
     
     public function getId() {
         return $this->id;
     }

     public function setId($id) {
         $this->id = $id;
     }

     public function getIdcite() {
         return $this->idcite;
     }

     public function setIdcite($idcite) {
         $this->idcite = $idcite;
     }

     public function getMotivo() {
         return $this->motivo;
     }

     public function setMotivo($motivo) {
         $this->motivo = $motivo;
     }


}

?>
