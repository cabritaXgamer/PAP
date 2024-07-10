<?php

class Database
{

    // Static variable to store the instance of the Database
    private static $instance = null;

    // Variable to store the PDO connection
    private $con;

    private function __construct()
    {
        try {
            $string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->con = new PDO($string, DB_USER, DB_PASS);
            // Set the PDO error mode to exception
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Method to get the singleton instance
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    // Method to get the PDO connection
    public function getConnection()
    {
        return $this->con;
    }

    // Method to read data from the database
    public function read($query, $data = array())
    {
        $stm = $this->con->prepare($query);
        $result = $stm->execute($data);

        if ($result) {
            $data = $stm->fetchAll(PDO::FETCH_OBJ);
            if (is_array($data) && count($data) > 0) {
                return $data;
            }
        }

        return false;
    }

    // Method to write data to the database
    public function write($query, $data = array())
    {
        $stm = $this->con->prepare($query);
        $result = $stm->execute($data);

        if ($result) {
            return true;
        }

        return false;
    }
}

/*
$db = Database::getInstance();
$data = $db->read("describe users");
show($data);
*/