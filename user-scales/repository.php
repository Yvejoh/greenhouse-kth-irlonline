<?php 

require_once("model.php");

class UserScaleRepository {
    private static $instance;
    private $db;

    private function __construct() {
        $this->db = DB::get();
    }

    public static function get() {
        if (!isset(self::$instance)) {
            self::$instance = new UserScaleRepository();
        }
        return self::$instance;
    }

    public function create($userId, $scaleId) {
        $query = sprintf("INSERT INTO %s(%s,%s,%s,%s) VALUES(?,?,?,?)", 
            UserScaleModel::Table(),
            UserScaleModel::USER_ID,
            UserScaleModel::SCALE_ID,
            UserScaleModel::CURRENT_LEVEL,
            UserScaleModel::PLANNED_LEVEL);

        $currentLevel = 1;
        $plannedLevel = 1; 
        $stmt = $this->db->prepare($query);
        if (!$stmt->execute([$userId, $scaleId, $currentLevel, $plannedLevel])) {
            throw new Exception((sprintf("Error: unable to create entry for user %d and scale %d", $userID, $scaleId)));
        }

        return $this->db->lastInsertId();
    }
}

?>