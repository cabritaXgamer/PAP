<?php
class Database
{
    public static $con;
    public function __construct()
    {
        try{

            $string= DB_TYPE . ":host=". DB_HOST.";dbname=". DB_NAME;
            self::$con = new PDO($string,DB_USER,DB_PASS);
        }catch (PDOException $e){
            die($e->getMessage());

        }
    }
public static function getInstance()
{
 if(self::$con){
    return self::$con;

 }
return $instance = new self();   

}
//READ
public function read($query,$data = array())
{
 $stm = self::$con->prepare($query);
 $result = $stm->execute($data);

 if($result){
 $data = $stm->fetchAll(PDO::FETCH_OBJ);
 if(is_array($data))
 {
    return $data;
    }
}
return false;
}   
//write
public function write($query,$data = array())
{
    $stm = self::$con->prepare($query);
    $result = $stm->execute($data);

 if($result){

 {
    return $data;
    }
}
return false;
}  
}
