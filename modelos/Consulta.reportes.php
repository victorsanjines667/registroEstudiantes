<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Consulta
 *
 * @author Linder
 */
include_once "../librerias/BDPG.class.php";

class Consulta extends BDPG{
    //put your code here
    
    public function getDatosCertificadoCartera($id){
        $datos = array();
        $this->conexionDB();
        $sql = "select c.nombrecompleto,c.ci,c.fechainicio,c.fechacertificado,c.articulo,
                c.nombresolicitante,ci.cite,cc.descripcion as cuentacont,tp.descripcion tipopres,
                fc.descripcion as fondo,c.monto,c.hojaruta,c.procedenciaci from certificado c join cite ci on c.idcite=ci.id
                join cuentacontable cc on c.idcuentacontable=cc.id
                join tipoprestamo tp on c.idtipoprestamo=tp.id
                join fondocomplementario fc on c.idfondocomplementario=fc.id
                where c.id=".$id;
        $resultado = $this->ejecutarConsulta($sql);
        while ($fila = $this->listaDatos($resultado)) {
            $datos[0] = $fila["nombrecompleto"];
            $datos[1] = $fila["ci"];
            $datos[2] = $fila["fechainicio"];
            $datos[3] = $fila["fechacertificado"];
            $datos[4] = $fila["articulo"];
            $datos[5] = $fila["nombresolicitante"];
            $datos[6] = $fila["cite"];
            $datos[7] = $fila["cuentacont"];
            $datos[8] = $fila["tipopres"];
            $datos[9] = $fila["fondo"];
            $datos[11] = $fila["monto"];
            $datos[12]= $fila["hojaruta"];
            $datos[13]= $fila["procedenciaci"];
        }
        //echo $datos;
        return $datos;
        $this->desconexionDB();
    }
}

?>
