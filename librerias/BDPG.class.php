<?php

/**
 * Vico
 */

class BDPG{
  
    private $servidor = "192.168.15.100";
    private $puerto = "5432";
    private $basededatos = "certificacionesfondos";
    private $usuario = "postgres";
    private $contrasena = "s3n4p3";
    private $conexion;
  
    public function conexionDB(){
        if(!isset($this->conexion)){
            $parametrodb = "host=".$this->servidor." dbname=".$this->basededatos." port=".$this->puerto." user=".$this->usuario." password=".$this->contrasena;
            $this->conexion = pg_connect($parametrodb) or die ('Ocurrio un error al conectarse a la base de datos: ' . pg_last_error());;
        }
    }

    public function ejecutarConsulta($sql){
        $resultado = pg_query($this->conexion,$sql) or die ("La consulta fallo1: ".pg_last_error($this->conexion));
        if(!isset($resultado)){
            echo "La consulta fallo2: ".pg_errormessage();
            exit;
        }
        return $resultado;
    }

    public function listaDatos($resultado){
        if(!is_resource($resultado)){
            return false;
        }
        return pg_fetch_assoc($resultado);
    }

    public function filasAfectadas($resultado){
        if(!is_resource($resultado)){
            return false;
        }
        return pg_num_rows($resultado);
    }

    public function desconexionDB(){
        pg_close($this->conexion);
    }

    public function verConsulta($sql){
        echo $sql;
    }
    
    function insertarLog($tabla,$operacion,$datosseriales,$idusuario,$idregistro,$sql){
        $sql = str_replace("'", "\'", $sql);
        $datosseriales = str_replace("'","\'",$datosseriales);
        $ip = "";
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else{
            $ip   = $_SERVER['REMOTE_ADDR'];
        }
        $sql = "insert into bitacora(tabla,operacion,datos,idusuario,fecha,idregistro,sql,ip) values('$tabla','$operacion','$datosseriales',$idusuario,current_timestamp,$idregistro,'$sql','$ip')";
        //$this->conexionDB();
        $this->ejecutarConsulta($sql);
        //$this->desconexionDB();
    }
}


?>