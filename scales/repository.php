<?php 

require_once("model.php");

class ScaleRepository {
    private static $instance;
    private $db;

    private function __construct() {
        $this->db = DB::get();
    }

    public static function get() {
        if (!isset(self::$instance)) {
            self::$instance = new ScaleRepository();
        }
        return self::$instance;
    }

    public function findAllIds() {
        $query = sprintf("SELECT %s FROM %s", ScaleModel::ID, ScaleModel::Table());
        $stmt =  $this->db->prepare($query);
        if (!$stmt->execute()) {
            die("Error: unable to fetch scales");
        }

        $rows =  $stmt->fetchAll();
        $ids = array();
        foreach ($rows as $row) {
            array_push($ids, $row[ScaleModel::ID]);
        }
        return $ids;
    }
}

?>