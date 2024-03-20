<?php

require_once 'sql/db.php';
require_once 'model.php';

class UserRepository {
    private static $instance;
    private $db;

    private function __construct() {
        $this->db = DB::get();
    }

    public static function get() {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new UserRepository();
        }
        return self::$instance;
    }

    public function findByUsername($username) {
        $query = sprintf("SELECT * FROM %s WHERE %s=?", UserModel::Table(), UserModel::$USERNAME);
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        if ($stmt->rowCount() != 0) {
            return $stmt->fetch();
        }
        return NULL;
    }

    public function create($username, $password) {
        $query = sprintf("INSERT INTO %s(%s,%s) VALUES(?,?)", 
            UserModel::Table(), UserModel::$USERNAME, UserModel::$PASSWORD);
        return $this->db->prepare($query)->execute([$username, $password]);
    }
}

?>