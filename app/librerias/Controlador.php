<?php 
////Clase controlador Principal

//se encarga depoder cargar los modelos y las vistas
class Controlador {
///Cargar Modelo

public function modelo($modelo){
    ///carga
    require_once '../app/modelos/'. $modelo . '.php';
    /// Instanciar el modelo

    return new $modelo();
}

public function vista($vista,$datos=[]){
    ///chequear si el archivo vista existe


    if(file_exists('../app/vista/'.$vista .'.php')){
    require_once '../app/vista/'.$vista .'.php';
    }else{
        //si la vista no existe
        die('la vista no existe');
    }
}

}