<?php
namespace Core;
use \PDO;
class Conn{
    public $connect;

    protected $user ="root";
    protected $pass ="";
    protected $charSet = "utf8";
    protected $option = array(
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8",
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION,
    );

    public function __construct(){
        try {
            $this->connect = new PDO('mysql:host=localhost;dbname=kvestik;charset='.$this->charSet,$this->user,$this->pass,$this->option);
        } catch (PDOException $e) {

            var_dump($e->getMessage());
            die();
        }
    }

    public function createComand(string $sql, array $param = []){
        $this->connect->prepare($sql)->execute($param);
    }
    
}