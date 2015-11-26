<?php
session_start();
include "librerias/BDPG.class.php";


class Login extends BDPG{
    
    public function Login(){
        
    }
    
    public function obtenerDatosUsuario($datosUsuario){
        $datos = array();
        $this->conexionDB();
        $caracteres = array("'","\"");
        $nombreusuario = str_replace($caracteres, " ", $datosUsuario['nombreusuario']);
        $contrasena = str_replace($caracteres, " ", $datosUsuario['password']);
        $sqlSicenad = " 
            select sub.nombre,sub.apellidopat,apellidomat,sub.usuario,sub.pass,sub.idfuncionario,au.idroles,au.iddireccion,dir.descripcion from 
            dblink('dbname=sicenad14 hostaddr=192.168.15.100 user=postgres password=js3QmA9vZ7edF2X port=5432',
            'select nombres,paterno,materno,usu_usuario,usu_contrasena,usu_funcionario from seguridad.usuarios seg 
            inner join personal.funcionarios fun on usu_funcionario = idfunc') as 
            sub(nombre varchar(120), apellidopat varchar(100),apellidomat varchar(100),usuario varchar(50), pass varchar(80),idfuncionario integer)
            inner join public.autorizados au on au.idfuncionario = sub.idfuncionario 
            inner join public.direccion dir on dir.id = au.iddireccion
            ------
            where sub.usuario ilike '$nombreusuario' and sub.pass ilike md5('$contrasena')
            ";
        $resultado = $this->ejecutarConsulta($sqlSicenad);
        if($this->filasAfectadas($resultado)>0){
            while($listadatos = $this->listaDatos($resultado)){
                $datos=$listadatos;
                $_SESSION['usuario']=$listadatos['usuario'];
                $_SESSION['nombre']=$listadatos['nombre'];
                $_SESSION['apellidopat']=$listadatos['apellidopat'];
                $_SESSION['apellidomat']=$listadatos['apellidomat'];
                $_SESSION['iddireccion']=$listadatos['iddireccion'];
                $_SESSION['dirdescripcion']=$listadatos['descripcion'];
                $_SESSION['idfuncionario']=$listadatos['idfuncionario'];
                $_SESSION['idrol'] = $listadatos['idroles'];
            }
        }
        return $datos;
        $this->desconexionDB();
    }
}

?>