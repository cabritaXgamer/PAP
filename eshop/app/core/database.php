<?php

Class Database 
{

    //Make conection to database mysql

    public static $con;

    public function __construct()
    {
        try{

            $string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
            //echo($string);
            self::$con = new PDO($string , DB_USER , DB_PASS);

        }
        catch (PDOException $e){

            die($e->getMessage());

        }

    }

    public static function getInstance()
    {
        if(self::$con)
        {
            return self::$con;
        }

        self::$con = new self();
    }


}

$db = Database::getInstance();

show($db);
