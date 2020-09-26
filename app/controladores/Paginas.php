<?php

class Paginas extends Controlador {
    public function __construct(){
    }

    public function index(){
        $datos =[
            'titulo'=>'Bienvenido a MVC render2web'
        ];
        $this->vista('paginas/inicio',$datos);
    }


}

