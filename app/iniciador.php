<?php 

///Cargando librerias
require 'config\configurar.php';
// require 'librerias\Database.php';
// require 'librerias\Controlador.php';
// require 'librerias\Core.php';




///AUTOLOAD PHP
///Cargando librerias
spl_autoload_register(function($nombreClase){
    require 'librerias/'.$nombreClase.'.php';
});