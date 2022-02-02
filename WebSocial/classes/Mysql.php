<?php
class Mysql{
    private static $pdo;
    public static function conectar(){
        if(self::$pdo == null){
            try{
                self::$pdo = new PDO('mysql:host='.HOST.';dbname='.DATABASE,USER,PASSWORD);
            }
            catch(Exception $e){
                echo'<h2>erro ao conectar :( <h2>';
                die('tente consultar um tecnico');
            }
        }
        return self::$pdo;
    }

}


?>
