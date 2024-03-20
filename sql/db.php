<?php 

class DB  {
    private static $instance;
    private $db;

    private function __construct() {

    /*
        $servername = "localhost";
        $database = "horseand_IRLscales";
        $username = "horseand_irlscales";
        $password = "[uoSf4PSU-}U";
    */

        $host = "localhost";
        $database = "MYSQL";
        $username = "root";
        $password = "root";
        $charset = "UTF8";
        $datasource = "mysql:host=$host;dbname=$database;charset=$charset";
        $this->db = new PDO($datasource, $username, $password);
    }

    public static function get() {
        if (!isset(self::$instance))
        {
            self::$instance = new DB;
        }
        return self::$instance->db;
    }
}

?>