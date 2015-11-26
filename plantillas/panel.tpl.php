<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            .panel-principal-contenedor{
                width: 1000px;
                margin:0 auto;
            }
            #button {
                    padding: 0;
            }
            #button li {
                    display: inline;
            }
            #button li a {
                    font-family: Arial;
                    font-size:11px;
                    text-decoration: none;
                    float:left;
                    padding: 10px;
                    background-color: #2175bc;
                    color: #fff;
            }
            #button li a:hover {
                    background-color: #2586d7;
                    margin-top:-2px;
                    padding-bottom:12px;
            }
            .menu-superior{
                background-color: #2586d7;
            }
            .contenedor-aplicacion{
                float:left;
                width: 90%;
                
            }
            .contenido{
                clear:both;
            }
            .panel{
                width: 30%;
                height: 150px;
                border: 1px solid #d2e3eb;
                margin:5px;
                float:left;
            }
            .panel:hover {
                background-color: #ffe3a3;
            }
            .panel h4{
                color: #63a2c2;
            }
            .contenedor-aplicacion-head h4{
                color: #2175bc;
            }
        </style>
    </head>
    <body>
        <div class="panel-principal-contenedor">
            <div class="menu-superior">
                <ul id="button">
                  <li><a href="#">Inicio</a></li>
                  <li><a href="#">Estudiantes</a></li>
                  <li><a href="#">Materias</a></li>
                  <li><a href="#">Docentes</a></li>
                  <li><a href="#">Horarios</a></li>
                  <li><a href="#">Reportes</a></li>

                  <li><a href="#">Ayuda</a></li>
                  <li><a href="#">Contactos</a></li>
                </ul>
              </div>
            <div class="contenido">
                <div class="contenedor-aplicacion">
                    <div class="contenedor-aplicacion-head"><h4>Panel Principal</h4></div>
                    <div class="contenedor-aplicacion-cuerpo">
                        <div class="panel">
                            <h4>Estudiantes</h4>
                        </div>
                        <div class="panel">
                            <h4>Horarios</h4>
                        </div>
                        <div class="panel">
                            <h4>Materias</h4>
                        </div>
                        <div class="panel">
                            <h4>Notas</h4>
                        </div>
                        <div class="panel">
                            <h4>Estudiantes</h4>
                        </div>
                        <div class="panel">
                            <h4>Estudiantes</h4>
                        </div>
                    </div>
                </div>
                <div class="contenedor-aplicacion">
                </div>
            </div>
        </div>
        <script type="text/javascript">
        
        </script>
    </body>
</html>
