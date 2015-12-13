<?php
if(empty($_SESSION)){
    session_start();
}
include_once("../librerias/BDPG.class.php");

class Contabilidad extends BDPG{
    private $id;
    private $tipoCertificado;
    private $nombrePersona;
    private $ci;
    private $nroCuenta;
    private $cargo;
    private $fechaInicio;
    private $fechaFinal;
    private $hojaRuta;
    private $fondoComplementario;
    private $genero;
    private $textoNota;
    private $tipoPrestamo;
    private $monto;
    private $fechaEmision;
    
    public function setFechaEmision($fechaEmision){
        $this->fechaEmision = $fechaEmision;
    }
    
    public function getFechaEmision(){
        return $this->fechaEmision;
    }
    
    public function setMonto($monto){
        $this->monto = $monto;
    }
    
    public function getMonto(){
        return $this->monto;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setTipoPrestamo($tipoPrestamo){
        $this->tipoPrestamo = $tipoPrestamo;
    }
    
    public function getTipoPrestamo(){
        return $this->tipoPrestamo;
    }
    
    public function setNombrePersona($nombrePersona){
        $this->nombrePersona = $nombrePersona;
    }
    
    public function setCi($ci){
        $this->ci = $ci;
    }
    
    public function setNroCuenta($nrocuenta){
        $this->nroCuenta = $nrocuenta;
    }
    
    public function setCargo($cargo){
        $this->cargo = $cargo;
    }
    
    public function setFechaInicio($fechaInicio){
        $this->fechaInicio = $fechaInicio;
    }
    
    public function setFechaFinal($fechaFinal){
        $this->fechaFinal = $fechaFinal;
    }
    
    public function setHojaRuta($hojaRuta){
        $this->hojaRuta = $hojaRuta;
    }
    
    public function setFondoComplementario($fondoComplementario){
        $this->fondoComplementario = $fondoComplementario;
    }
    
    public function setArticulo($genero){
        $this->genero = $genero;
    }
    
    public function setTextoNota($textoNota){
        $this->textoNota = $textoNota;
    }
    
    public function setTipoCertificado($tipoCertificado){
        $this->tipoCertificado = $tipoCertificado;
    }
    
    public function getTipoCertificado(){
        return $this->tipoCertificado;
    }
    
    public function getNombrePersona(){
        return $this->nombrePersona;
    }
    
    public function getCi(){
        return $this->ci;
    }
    
    public function getNroCuenta(){
        return $this->nroCuenta;
    }
    
    public function getCargo(){
        return $this->cargo;
    }
    
    public function getFechaInicio(){
        return $this->fechaInicio;
    }
    
    public function getFechaFinal(){
        return $this->fechaFinal;
    }
    
    public function getHojaRuta(){
        return $this->hojaRuta;
    }
    
    public function getFondoComplementario(){
        return $this->fondoComplementario;
    }
    
    public function getArticulo(){
        return $this->genero;
    }
    
    public function getTextoNota(){
        return $this->textoNota;
    }
    
    public function insertarCertificadoContabilidad($certificado){
        if(!strcmp($certificado->getFechaFinal(),"null")){
            $fechafinal = "null";
        }else{
            $fechafinal = "'".$certificado->getFechaFinal()."'::date";
        }
        $sql = "select insertarcertificadocontabilidad('".$certificado->getNombrePersona()."','".$certificado->getCi()."',".$certificado->getNroCuenta().",'".$certificado->getMonto()."','".$certificado->getCargo()."','".$certificado->getFechaInicio()."'::date,$fechafinal,".$certificado->getFondoComplementario().",'".$certificado->getHojaRuta()."','".$certificado->getArticulo()."','".$certificado->getTextoNota()."',$_SESSION[idfuncionario],'".$certificado->getTipoCertificado()."','".$certificado->getFechaEmision()."'::date)";
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        $resultado = $this->listaDatos($consulta);
        return $resultado['insertarcertificadocontabilidad'];
		//return "47";
        $this->desconexionDB();
    }
    
    
     public function updateCertificadoContabilidad($certificado){
         
         
        if(!strcmp($certificado->getFechaFinal(),"null")){
            $fechafinal = "null";
        }else{
            $fechafinal = "'".$certificado->getFechaFinal()."'::date";
        }
        
        $id = $certificado->getId();
        $tipocertificado = $certificado->getTipoCertificado();
        $nombrepersona = $certificado->getNombrePersona();
        $ci = $certificado->getCi();
        $fondocomplementario = $certificado->getFondoComplementario();
        $fechainicio = $certificado->getFechaInicio();
        $monto = $certificado->getMonto(); //*
        $cargo = $certificado->getCargo(); //*
        //$fechafinal = $certContabilidad->getFechaFinal(); //*
        $nrocuenta = $certificado->getNroCuenta(); //*
        $hojaruta = $certificado->getHojaRuta();
        $articulo = $certificado->getArticulo();
        $textonota = $certificado->getTextoNota();
        $fechacertificado = $certificado->getFechaEmision();        
        
        $sql = "update public.certificado set 
                idtipocertificado=$tipocertificado,
                nombrecompleto='$nombrepersona',
                ci='$ci',
                idfondocomplementario=$fondocomplementario,
                fechainicio='$fechainicio'::date,
                monto='$monto',
                cargo='$cargo',
                fechafin=$fechafinal,
                idcuentacontable=$nrocuenta,
                hojaruta='$hojaruta',
                articulo='$articulo',
                nombresolicitante='$textonota',
                fechacertificado='$fechacertificado'     
                 where id=$id";
        
        //$sql = "select insertarcertificadocontabilidad('".$certificado->getNombrePersona()."','".$certificado->getCi()."',".$certificado->getNroCuenta().",'".$certificado->getMonto()."','".$certificado->getCargo()."','".$certificado->getFechaInicio()."'::date,$fechafinal,".$certificado->getFondoComplementario().",'".$certificado->getHojaRuta()."','".$certificado->getArticulo()."','".$certificado->getTextoNota()."',15,'".$certificado->getTipoCertificado()."')";
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        $this->desconexionDB();
    }
            
    public function getCertificadoContabilidad($idcertificado){
        $sql = "select a.nombrecompleto,a.ci,
                to_char(a.fechainicio::date,'dd/mm/yyyy') as finicio,
                to_char(a.fechafin::date,'dd/mm/yyyy') as ffin,
                to_char(a.fechacertificado::date,'dd/mm/yyyy') as fcertificado,
                a.monto,a.cargo,a.hojaruta,
                a.idcuentacontable,a.idtipocertificado,a.articulo,
                a.nombresolicitante,a.idcite,a.idfondocomplementario
                from certificado a
                --join cite ci on c.idcite=ci.id 
                where a.id =$idcertificado";
        $this->conexionDB();
        $consulta = $this->ejecutarConsulta($sql);
        if($this->filasAfectadas($consulta)>0){
            $certContabilidad = new Contabilidad();
            while($listadatos = $this->listaDatos($consulta)){
                $certContabilidad->setId($idcertificado);
                $certContabilidad->setTipoCertificado($listadatos['idtipocertificado']);
                $certContabilidad->setNombrePersona($listadatos['nombrecompleto']);
                $certContabilidad->setCi($listadatos['ci']);
                $certContabilidad->setFondoComplementario($listadatos['idfondocomplementario']);
                $certContabilidad->setFechaInicio($listadatos['finicio']);
                $certContabilidad->setMonto($listadatos['monto']); //*
                $certContabilidad->setCargo($listadatos['cargo']); //*
                $certContabilidad->setFechaFinal($listadatos['ffin']); //*
                $certContabilidad->setNroCuenta($listadatos['idcuentacontable']);
                $certContabilidad->setHojaRuta($listadatos['hojaruta']);
                $certContabilidad->setArticulo($listadatos['articulo']);
                $certContabilidad->setFechaEmision($listadatos['fcertificado']);
                $certContabilidad->setTextoNota($listadatos['nombresolicitante']);
            }
            return $certContabilidad;
        }else{
            return null;
        }
        $this->desconexionDB();
    }
}

?>