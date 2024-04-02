<?php 

require_once("scales/model.php");
require_once('sql/db.php');
require_once("model.php");
require_once("user_scale_summary.php");

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

    public function getUserScales($userId) {
        $query = sprintf("SELECT %s, %s, %s, %s FROM %s LEFT JOIN %s ON %s = %s WHERE %s = ?",
                            sprintf("%s.%s",ScaleModel::Table(), ScaleModel::ID),
                            sprintf("%s.%s",ScaleModel::Table(), ScaleModel::TITLE),
                            sprintf("%s.%s",UserScaleModel::Table(), UserScaleModel::CURRENT_LEVEL),
                            sprintf("%s.%s",UserScaleModel::Table(), UserScaleModel::PLANNED_LEVEL),
                            UserScaleModel::Table(),
                            ScaleModel::Table(),
                            sprintf("%s.%s", UserScaleModel::Table(), UserScaleModel::SCALE_ID),
                            sprintf("%s.%s", ScaleModel::Table(), ScaleModel::ID),
                            sprintf("%s.%s", UserScaleModel::Table(), UserScaleModel::USER_ID));

        $stmt = $this->db->prepare($query);
        if (!$stmt->execute([$userId])) {
            throw new Exception((sprintf("Error: unable to find user scales for user %d", $userID, $scaleId)));
        }        

        $rows =  $stmt->fetchAll();
        $userScales = array();
        foreach ($rows as $row) {
            $summary = new UserScaleSummary($row[ScaleModel::ID],
                                            $row[ScaleModel::TITLE],
                                            $row[UserScaleModel::CURRENT_LEVEL],
                                            $row[UserScaleModel::PLANNED_LEVEL]);
            $userScales[]=$summary;
        }
        return $userScales;
    }
}

?>