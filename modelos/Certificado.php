<?php
if(empty($_SESSION)){
    session_start();
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Certificado
 *
 * @author Linder
 */
include_once "../librerias/BDPG.class.php";

class Certificado extends BDPG{
    //put your code here
    private $id;
    private $nombreCompleto;
    private $ci;
    private $cargo;
    private $fechaInicio;
    private $fechaFin;
    private $conProceso;
    private $notaCargo;
    private $monto;
    private $lugarRadicado;
    private $hojaRuta;
    private $eliminado;
    private $idCuentaContable;
    private $idTipoCertificado;
    private $tipoPrestamo;
    private $articulo;
    private $nombreSolicitante;
    private $idCite;
    private $idFondoComplementario;
    private $fechaCertificado;
    private $procedenciaCi;
    
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombreCompleto() {
        return $this->nombreCompleto;
    }

    public function setNombreCompleto($nombreCompleto) {
        $this->nombreCompleto = $nombreCompleto;
    }

    public function getCi() {
        return $this->ci;
    }

    public function setCi($ci) {
        $this->ci = $ci;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    public function getFechaFin() {
        return $this->fechaFin;
    }

    public function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    public function getConProceso() {
        return $this->conProceso;
    }

    public function setConProceso($conProceso) {
        $this->conProceso = $conProceso;
    }

    public function getNotaCargo() {
        return $this->notaCargo;
    }

    public function setNotaCargo($notaCargo) {
        $this->notaCargo = $notaCargo;
    }

    public function getMonto() {
        return $this->monto;
    }

    public function setMonto($monto) {
        $this->monto = $monto;
    }

    public function getLugarRadicado() {
        return $this->lugarRadicado;
    }

    public function setLugarRadicado($lugarRadicado) {
        $this->lugarRadicado = $lugarRadicado;
    }

    public function getHojaRuta() {
        return $this->hojaRuta;
    }

    public function setHojaRuta($hojaRuta) {
        $this->hojaRuta = $hojaRuta;
    }

    public function getEliminado() {
        return $this->eliminado;
    }

    public function setEliminado($eliminado) {
        $this->eliminado = $eliminado;
    }

    public function getIdCuentaContable() {
        return $this->idCuentaContable;
    }

    public function setIdCuentaContable($idCuentaContable) {
        $this->idCuentaContable = $idCuentaContable;
    }

    public function getIdTipoCertificado() {
        return $this->idTipoCertificado;
    }

    public function setIdTipoCertificado($idTipoCertificado) {
        $this->idTipoCertificado = $idTipoCertificado;
    }

    public function getTipoPrestamo() {
        return $this->tipoPrestamo;
    }

    public function setTipoPrestamo($tipoPrestamo) {
        $this->tipoPrestamo = $tipoPrestamo;
    }

    public function getArticulo() {
        return $this->articulo;
    }

    public function setArticulo($articulo) {
        $this->articulo = $articulo;
    }

    public function getNombreSolicitante() {
        return $this->nombreSolicitante;
    }

    public function setNombreSolicitante($nombreSolicitante) {
        $this->nombreSolicitante = $nombreSolicitante;
    }
    
    public function getIdCite() {
        return $this->idCite;
    }

    public function setIdCite($idCite) {
        $this->idCite = $idCite;
    }

    public function getIdFondoComplementario() {
        return $this->idFondoComplementario;
    }

    public function setIdFondoComplementario($idFondoComplementario) {
        $this->idFondoComplementario = $idFondoComplementario;
    }
	
	public function getFechaCertificado() {
        return $this->fechaCertificado;
    }

    public function setFechaCertificado($fechaCertificado) {
        $this->fechaCertificado = $fechaCertificado;
    }

    public function getProcedenciaCi() {
        return $this->procedenciaCi;
    }

    public function setProcedenciaCi($procedenciaCi) {
        $this->procedenciaCi = $procedenciaCi;
    }

    
    public function getCertificadoCartera($idCerticado){
        $sql = "select c.id,c.nombrecompleto,c.ci,c.monto,c.hojaruta,
                c.idcuentacontable,c.idtipoprestamo,c.articulo,c.idtipoprestamo,
                c.idfondocomplementario,to_char(c.fechainicio::date,'dd/mm/yyyy') as fecha,
                c.nombresolicitante,to_char(c.fechacertificado::date,'dd/mm/yyyy')as fechacertificado,c.procedenciaci  from certificado c
                where c.id=".$idCerticado;
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        if($this->filasAfectadas($consulta)>0){
            $certificado = new Certificado();
            while($listadatos = $this->listaDatos($consulta)){
                $certificado->setId($listadatos["id"]);
                $certificado->setNombreCompleto($listadatos["nombrecompleto"]);
                $certificado->setCi($listadatos["ci"]);
                $certificado->setFechaInicio($listadatos["fecha"]);
                $certificado->setMonto($listadatos["monto"]);
                $certificado->setHojaRuta($listadatos["hojaruta"]);
                $certificado->setTipoPrestamo($listadatos["idtipoprestamo"]);
                $certificado->setIdCuentaContable($listadatos["idcuentacontable"]);
                $certificado->setNombreSolicitante($listadatos["nombresolicitante"]);
                $certificado->setIdFondoComplementario($listadatos["idfondocomplementario"]);
                $certificado->setArticulo($listadatos["articulo"]);
                $certificado->setFechaCertificado($listadatos["fechacertificado"]);
                $certificado->setProcedenciaCi($listadatos["procedenciaci"]);
            }
            return $certificado;
        }else{
            return null;
        }
        $this->desconexionDB();
    }
    public function insertarCertificado($certificado){
        $sql = "select insertarcertificadocartera('".$certificado->getNombreCompleto()."', '".$certificado->getCi()."',".$certificado->getIdCuentaContable()." , '".$certificado->getMonto()."', '".$certificado->getFechaInicio()."'::date,".$certificado->getTipoPrestamo().", ".$certificado->getIdFondoComplementario().", '".$certificado->getHojaRuta()."', '".$certificado->getArticulo()."', '".$certificado->getNombreSolicitante()."',".$_SESSION['idfuncionario'].",'".$certificado->getFechaCertificado()."','".$certificado->getProcedenciaCi()."')";
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        $resultado = 0;
        if($this->filasAfectadas($consulta)>0){
            while($listadatos = $this->listaDatos($consulta)){
                $resultado = $listadatos["insertarcertificadocartera"];     
            }   
        }
        return $resultado;
        $this->desconexionDB();
        //return $sql;
    }
	
    public function editarCertificado($certificado){
        $sql = "update certificado set nombrecompleto='".$certificado->getNombreCompleto()."',
                fechainicio='".$certificado->getFechaInicio()."',
                ci='".$certificado->getCi()."',idcuentacontable=".$certificado->getIdCuentaContable().",
                monto='".$certificado->getMonto()."',idtipoprestamo=".$certificado->getTipoPrestamo().",
                idfondocomplementario=".$certificado->getIdFondoComplementario().", hojaruta='".$certificado->getHojaRuta()."',
                articulo='".$certificado->getArticulo()."', nombresolicitante='".$certificado->getNombreSolicitante()."',
                fechacertificado='".$certificado->getFechaCertificado()."',
                procedenciaci = '".$certificado->getProcedenciaCi()."' where id=".$certificado->getId()." returning id";
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        if($this->filasAfectadas($consulta)>0){
            while($listadatos = $this->listaDatos($consulta)){
                $resultado = $listadatos["id"];     
            }   
        }
        return $resultado;
        $this->desconexionDB();
    }
	
	public function editarCertificadoJuridica($certificado){
	    $sql = "update certificado set nombrecompleto='".$certificado->getNombreCompleto()."',
                ci='".$certificado->getCi()."',notacargo='".$certificado->getNotaCargo()."',
                monto='".$certificado->getMonto()."',idtipocertificado=".$certificado->getIdTipoCertificado().",
                lugarradicado='".$certificado->getLugarRadicado()."', hojaruta='".$certificado->getHojaRuta()."',
				idfondocomplementario = ".$certificado->getIdFondoComplementario().",
                articulo='".$certificado->getArticulo()."', fechacertificado='".$certificado->getFechaCertificado()."', nombresolicitante='".$certificado->getNombreSolicitante()."' where id=".$certificado->getId();
        

        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        $resultado = 1;
        return $resultado;
        $this->desconexionDB();
        //return $sql;
	}
    
	public function insertarCertificadoJuridica($certificado){
        $sql = "select insertarcertificadojuridica('".$certificado->getNombreCompleto()."', '".$certificado->getCi()."', '".$certificado->getNotaCargo()."' , ".$certificado->getIdTipoCertificado().", '".$certificado->getMonto()."', '".$certificado->getLugarRadicado()."', '".$certificado->getHojaRuta()."', ".$certificado->getIdFondoComplementario().", '".$certificado->getArticulo()."', ".$certificado->getConProceso().", ".$_SESSION['idfuncionario'].", '".$certificado->getNombreSolicitante()."', '".$certificado->getFechaCertificado()."')";
        
		$this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        $resultado = 0;
        if($this->filasAfectadas($consulta)>0){
            while($listadatos = $this->listaDatos($consulta)){
                $resultado = $listadatos["insertarcertificadojuridica"];     
            }   
        }
        return $resultado;
        $this->desconexionDB();
        //return $sql;
    }
     public function listaCertificados($condicion=""){
        $datos = array();
        $this->conexionDB();
        $sql="select * from vistacertificados where eliminado=false and idfuncionario=".$_SESSION["idfuncionario"]." ".$condicion;
        //echo "listarConsulta:". $sql;
        $resultado = $this->ejecutarConsulta($sql);
        while ($fila = $this->listaDatos($resultado)) {
            $datos[] = $fila;
        }
        return $datos;
        $this->desconexionDB();
    }
    
    public function getNumeroFilasCertificados($condicion = null) {
        $sql = "SELECT count(id) FROM public.certificado ".$condicion;
        echo $sql;
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        //$nroFilas = $this->filasAfectadas($consulta);
        $nroFilas = $this->listaDatos($consulta);
        return $nroFilas["count"];
        $this->desconexionDB();
    }
	
	public function getCertificadoJuridica($idCerticado){
        $sql = "SELECT c.id,c.nombrecompleto,c.ci,c.notacargo,c.monto,c.hojaruta,
                c.idtipocertificado,c.articulo,c.lugarradicado,c.idfondocomplementario,to_char(ci.fecha::date,'dd/mm/yyyy') as fecha,
				c.nombresolicitante, c.conproceso, to_char(c.fechacertificado::date, 'dd/mm/yyyy') as fechacertificado
				FROM certificado c join cite ci on c.idcite=ci.id 
                where c.id=".$idCerticado;
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        if($this->filasAfectadas($consulta)>0){
            $certificado = new Certificado();
            while($listadatos = $this->listaDatos($consulta)){
                $certificado->setId($listadatos["id"]);
                $certificado->setNombreCompleto($listadatos["nombrecompleto"]);
                $certificado->setCi($listadatos["ci"]);
                $certificado->setNotaCargo($listadatos["notacargo"]);
                $certificado->setMonto($listadatos["monto"]);
                $certificado->setHojaRuta($listadatos["hojaruta"]);
                $certificado->setIdTipoCertificado($listadatos["idtipocertificado"]);
                $certificado->setNombreSolicitante($listadatos["nombresolicitante"]);
                $certificado->setIdFondoComplementario($listadatos["idfondocomplementario"]);
				$certificado->setLugarRadicado($listadatos["lugarradicado"]);
                $certificado->setArticulo($listadatos["articulo"]);
				$certificado->setConProceso($listadatos["conproceso"]);
				$certificado->setFechaCertificado($listadatos["fechacertificado"]);
				
            }
            return $certificado;
        }else{
            return null;
        }
        $this->desconexionDB();
    }
	
	public function getCertificadoGeneral($idCerticado){
        $sql = "SELECT c.id,c.nombrecompleto,c.ci,c.notacargo,c.monto,c.hojaruta,c.cargo,c.idcuentacontable,
                c.idtipocertificado,c.articulo,c.lugarradicado,c.idfondocomplementario, c.fechainicio,c.fechafin,
				c.nombresolicitante, c.conproceso, to_char(c.fechacertificado::date, 'dd/mm/yyyy') as fechacertificado,
				c.idcite
				FROM certificado c
                where c.id=".$idCerticado;
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        if($this->filasAfectadas($consulta)>0){
            $certificado = new Certificado();
            while($listadatos = $this->listaDatos($consulta)){
                $certificado->setId($listadatos["id"]);
                $certificado->setNombreCompleto($listadatos["nombrecompleto"]);
                $certificado->setCi($listadatos["ci"]);
				$certificado->setCargo($listadatos["cargo"]);
				$certificado->setFechaInicio($listadatos["fechainicio"]);
				$certificado->setFechaFin($listadatos["fechafin"]);
                $certificado->setNotaCargo($listadatos["notacargo"]);
                $certificado->setMonto($listadatos["monto"]);
                $certificado->setHojaRuta($listadatos["hojaruta"]);
                $certificado->setIdTipoCertificado($listadatos["idtipocertificado"]);
                $certificado->setNombreSolicitante($listadatos["nombresolicitante"]);
                $certificado->setIdFondoComplementario($listadatos["idfondocomplementario"]);
				$certificado->setLugarRadicado($listadatos["lugarradicado"]);
                $certificado->setArticulo($listadatos["articulo"]);
				$certificado->setConProceso($listadatos["conproceso"]);
				$certificado->setFechaCertificado($listadatos["fechacertificado"]);
				$certificado->setIdCuentaContable($listadatos["idcuentacontable"]);
				$certificado->setIdCite($listadatos["idcite"]);
				
            }
            return $certificado;
        }else{
            return null;
        }
        $this->desconexionDB();
    }
    
    public function getNumeroFilasCertificados2($condicion = null) {
        /*$sql = "select c.id,c.nombrecompleto,c.ci,ci.cite,ci.fecha::date,c.hojaruta,c.nombresolicitante,fc.descripcion as fondo from certificado c join cite ci on c.idcite=ci.id
        join fondocomplementario fc on c.idfondocomplementario=fc.id where c.eliminado=false ".$condicion;*/
        $sql="select * from vistacertificados where eliminado=false and idfuncionario=".$_SESSION["idfuncionario"]." ".$condicion;
        //echo "sCondicion:".$sql;
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        $nroFilas = $this->filasAfectadas($consulta);
        return $nroFilas;
        $this->desconexionDB();
    }
    
    public function eliminarCertificado($id){
        $sql = "update certificado set eliminado=true where id=".$id." returning id";
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        if($this->filasAfectadas($consulta)>0){
            while($listadatos = $this->listaDatos($consulta)){
                $resultado = $listadatos["id"];     
            }   
        }
        return $resultado;
         $this->desconexionDB();
    }
    
    public function getTipoCertificado($idcertificado){
        $sql = "SELECT c.idtipocertificado
            	FROM certificado c 
                where c.id=".$idcertificado;
        $this->conexionDB();
        $resultado = $this->ejecutarConsulta($sql);
        if($this->filasAfectadas($resultado)>0){
            while($listadatos = $this->listaDatos($resultado)){
                $tipoCertificado = $listadatos['idtipocertificado'];
            }
            return $tipoCertificado;
        }else{
            return null;
        }
        $this->desconexionDB();
    }
}

?>
