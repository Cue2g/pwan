<?php
////clase para conetarse a la base de datos y ejecutar consulta PDO
class Base{
    private $host = BD_HOST;
    private $usuario = BD_USUARIO;
    private $password = BD_PASSWORD;
    private $nombre_base = BD_NOMBRE;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        // configurar conexion

        $dsn = 'mysql:host='.$this->host .';dbname='.$this->nombre_base;

        
        $opciones = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //Crear una instancia de PDO

        try{
            $this->dbh =new PDO($dsn,$this->usuario,$this->password,$opciones);
            $this->dbh->exec('set names utf8');
            echo 'conectado';
        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    //preparamos la consulta
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }
          /// vinculamos la consulta con bind
    public function bind ($parametro, $valor , $tipo = null){
        if (is_null($tipo)){
            switch(true){
            case is_int($valor):
            $tipo = PDO::PARAM_INT;
            break;

            case is_bool($valor):
            $tipo = PDO::PARAM_BOOL;
            break;

            case is_null($valor):
                $tipo = PDO::PARAM_NULL;
                break;
            default:
            $tipo = PDO::PARAM_NULL;
            break;
            }
     
        }
        $this->stmt->bindvalue($parametro,$valor,$tipo);
    }
    ///Ejecuta la consulta
    public function execute(){
       return $this->stmt->execute();
    }

    //obtener los registros del aconsulta

    public function registros(){
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
/// obtener un solo registro
    public function registro(){
        $this->execute();
        echo $this->stmt;
        return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

    /// obtener cantidad de filas con el metodo rowcount

    public function rowCount(){ 
            $this->execute();
            return $this->stmt->rowCount();    
    }
    
}
