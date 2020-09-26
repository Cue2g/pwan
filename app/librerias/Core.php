<?php

/*
Mapear la url ingresada en el navegador,

1-controlador
2-metodo
3-parametro
/ariculos/actualizar/4
*/

class Core
{
    protected $controladorActual = 'Paginas';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct(){

         $url = $this->getUrl();

        /// Buscar en controladores si el controlador existe existe

        if (isset($url[0])) {
            if (file_exists('../app/controladores/' . ucwords($url[0]) . '.php')) {
                //// si existe se setea, como controlador por defecto
                $this->controladorActual = ucwords($url[0]);


                //unset indice 

                unset($url[0]);
            }
        }
        /// requerir el controlador

        require_once '../app/controladores/' . $this->controladorActual . '.php';
        $this->controladorActual = new $this->controladorActual;



        //Chequear la segunda parte del url (Metodo)

        if(isset($url[1])){
            if(method_exists($this->controladorActual, $url[1])){
                //chequeamos el metodo
                $this->metodoActual = $url[1];
                ///unset indice
                unset($url[1]);
            }
        }
        // para probar traer metodo 
        // echo $this->metodoActual;


        // obtener los posibles parametros 

        $this->parametros = $url ? array_values($url) : [];

        //llamar callback con parametros array

        call_user_func_array([$this->controladorActual, $this->metodoActual],$this->parametros);
    }

    public function getUrl()
    {
        // echo $_GET['url'];

        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return ($url);
        }
    }
}
