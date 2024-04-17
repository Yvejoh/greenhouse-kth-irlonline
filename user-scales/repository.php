<?php 

require_once("scales/model.php");
require_once('sql/db.php');
require_once("model.php");
require_once("user_scale.php");

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

    public function getUserScales($userID) {
        $query = sprintf("SELECT %s, %s, %s FROM %s LEFT JOIN %s ON %s = %s WHERE %s = ?",
                            sprintf("%s.%s",ScaleModel::Table(), ScaleModel::ID),
                            sprintf("%s.%s",ScaleModel::Table(), ScaleModel::TITLE),
                            sprintf("%s.%s",UserScaleModel::Table(), UserScaleModel::CURRENT_LEVEL),
                            UserScaleModel::Table(),
                            ScaleModel::Table(),
                            sprintf("%s.%s", UserScaleModel::Table(), UserScaleModel::SCALE_ID),
                            sprintf("%s.%s", ScaleModel::Table(), ScaleModel::ID),
                            sprintf("%s.%s", UserScaleModel::Table(), UserScaleModel::USER_ID));

        $stmt = $this->db->prepare($query);
        if (!$stmt->execute([$userID]) || $stmt->rowCount() == 0) {
            throw new Exception((sprintf("Error: unable to find user scales for user %d", $userID)));
        }        

        $rows =  $stmt->fetchAll();
        $userScales = array();
        foreach ($rows as $row) {
            $userScale = new UserScale($row[ScaleModel::ID],
                                     $row[ScaleModel::TITLE],
                                     $row[UserScaleModel::CURRENT_LEVEL],
                                     null);
            $userScales[]=$userScale;
        }
        return $userScales;
    }
    
    public function getFullUserScales($userID) {
        $query = sprintf("SELECT %s,%s,%s,%s,%s,%s,%s,%s,%s,%s FROM %s LEFT JOIN %s ON %s = %s WHERE %s = ?",
                            sprintf("%s.%s",ScaleModel::Table(), ScaleModel::ID),
                            sprintf("%s.%s",ScaleModel::Table(), ScaleModel::TITLE),
                            sprintf("%s.%s",UserScaleModel::Table(), UserScaleModel::CURRENT_LEVEL),
                            sprintf("%s.%s",UserScaleModel::Table(), UserScaleModel::PLANNED_LEVEL),
                            sprintf("%s.%s",UserScaleModel::Table(), UserScaleModel::PLANNED_GOAL_ONE),
                            sprintf("%s.%s",UserScaleModel::Table(), UserScaleModel::PLANNED_GOAL_TWO),
                            sprintf("%s.%s",UserScaleModel::Table(), UserScaleModel::PLANNED_GOAL_THREE),
                            sprintf("%s.%s",UserScaleModel::Table(), UserScaleModel::DEADLINE_GOAL_ONE),
                            sprintf("%s.%s",UserScaleModel::Table(), UserScaleModel::DEADLINE_GOAL_TWO),
                            sprintf("%s.%s",UserScaleModel::Table(), UserScaleModel::DEADLINE_GOAL_THREE),
                            UserScaleModel::Table(),
                            ScaleModel::Table(),
                            sprintf("%s.%s", UserScaleModel::Table(), UserScaleModel::SCALE_ID),
                            sprintf("%s.%s", ScaleModel::Table(), ScaleModel::ID),
                            sprintf("%s.%s", UserScaleModel::Table(), UserScaleModel::USER_ID));

        $stmt = $this->db->prepare($query);
        if (!$stmt->execute([$userID]) || $stmt->rowCount() == 0) {
            throw new Exception((sprintf("Error: unable to find user scales for user %d", $userID)));
        }        

        $rows =  $stmt->fetchAll();
        $userScales = array();
        foreach ($rows as $row) {
            $goals = array();
            array_push($goals, 
            new ScaleGoal($row[UserScaleModel::PLANNED_GOAL_ONE], $row[UserScaleModel::DEADLINE_GOAL_ONE]),
            new ScaleGoal($row[UserScaleModel::PLANNED_GOAL_TWO], $row[UserScaleModel::DEADLINE_GOAL_TWO]),
            new ScaleGoal($row[UserScaleModel::PLANNED_GOAL_THREE], $row[UserScaleModel::DEADLINE_GOAL_THREE]));
            $userScale = new UserScale($row[ScaleModel::ID],
                                $row[ScaleModel::TITLE],
                                $row[UserScaleModel::CURRENT_LEVEL],
                                new UserScalePlanning($row[UserScaleModel::PLANNED_LEVEL],$goals));
            $userScales[]=$userScale;
        }
        return $userScales;
}

    /**
     * Gets user scale without planning
     */
    public function getUserScale($userID, $scaleID) {
        $query = sprintf("SELECT %s, %s, %s FROM %s LEFT JOIN %s ON %s = %s WHERE %s = ? AND %s = ?",
                            sprintf("%s.%s",ScaleModel::Table(), ScaleModel::ID),
                            sprintf("%s.%s",ScaleModel::Table(), ScaleModel::TITLE),
                            sprintf("%s.%s",UserScaleModel::Table(), UserScaleModel::CURRENT_LEVEL),
                            UserScaleModel::Table(),
                            ScaleModel::Table(),
                            sprintf("%s.%s", UserScaleModel::Table(), UserScaleModel::SCALE_ID),
                            sprintf("%s.%s", ScaleModel::Table(), ScaleModel::ID),
                            sprintf("%s.%s", UserScaleModel::Table(), UserScaleModel::USER_ID),
                            sprintf("%s.%s", UserScaleModel::Table(), UserScaleModel::SCALE_ID));

        $stmt = $this->db->prepare($query);
        if (!$stmt->execute([$userID, $scaleID]) || $stmt->rowCount() == 0) {
            throw new Exception((sprintf("Error: unable to find user scale for user %d and scale %d", $userID, $scaleID)));
        }         

        $row = $stmt->fetch();
        return new UserScale($row[ScaleModel::ID],
                             $row[ScaleModel::TITLE],
                             $row[UserScaleModel::CURRENT_LEVEL],
                             null);
    }

    public function getScaleLevels($userID) {
        $query = sprintf("SELECT %s,%s FROM %s where %s = ? AND",
            UserScaleModel::SCALE_ID,
            UserScaleModel::CURRENT_LEVEL,
            UserScaleModel::Table(),
            UserScaleModel::USER_ID);

        $stmt = $this->db->prepare($query);
        if (!$stmt->execute([$userID]) || $stmt->rowCount() == 0) {
            throw new Exception(sprintf("Error: unable to find scale levels for user %d", $userID, $scaleID));
        } 
        $rows =  $stmt->fetchAll();
        $levels = array();
        foreach ($rows as $row) {
            $level = new UserScaleLevel($row[UserScaleModel::SCALE_ID],
                                    $row[UserScaleModel::CURRENT_LEVEL]);
            $levels[]=$level;
        }        
    }

    public function getScaleLevel($userID, $scaleID) {
        $query = sprintf("SELECT %s,%s FROM %s where %s = ? AND %s = ?",
            UserScaleModel::SCALE_ID,
            UserScaleModel::CURRENT_LEVEL,
            UserScaleModel::Table(),
            UserScaleModel::USER_ID,
            UserScaleModel::SCALE_ID);

        $stmt = $this->db->prepare($query);
        if (!$stmt->execute([$userID, $scaleID]) || $stmt->rowCount() == 0) {
            throw new Exception(sprintf("Error: unable to find scale level for user %d and scale %d", $userID, $scaleID));
        } 
        $row = $stmt->fetch();
        return new UserScaleLevel($row[UserScaleModel::SCALE_ID],
                              $row[UserScaleModel::CURRENT_LEVEL]);
    }

    public function updateScaleLevel($userID, $scaleID, $level) {
        $query = sprintf("UPDATE %s SET %s = ? WHERE %s = ? AND %s = ?",
                            UserScaleModel::Table(),
                            UserScaleModel::CURRENT_LEVEL,
                            UserScaleModel::USER_ID,
                            UserScaleModel::SCALE_ID);
        
        $stmt = $this->db->prepare($query);
        if (!$stmt->execute([$level,$userID, $scaleID])) {
            throw new Exception(sprintf("Error: unable to update scale level for user %d and scale %d", $userID, $scaleID));
        }        
    }

    public function updatePlannedLevel($userID, $scaleID, $plannedLevel) {
        $query = sprintf("UPDATE %s SET %s = ? WHERE %s = ? AND %s = ?",
                            UserScaleModel::Table(),
                            UserScaleModel::PLANNED_LEVEL,
                            UserScaleModel::USER_ID,
                            UserScaleModel::SCALE_ID);

        $stmt = $this->db->prepare($query);
        if (!$stmt->execute([$plannedLevel,$userID, $scaleID])) {
            throw new Exception(sprintf("Error: unable to update planned level for user %d and scale %d", $userID, $scaleID));
        }        
    }

    public function updatePlannedGoals($userID, $scaleID,
                                    $plannedGoal1, $deadline1,
                                    $plannedGoal2, $deadline2,
                                    $plannedGoal3, $deadline3) {

        $query = sprintf("UPDATE %s SET %s = ?, %s = ?, %s = ?,%s = ?, %s = ?, %s = ? WHERE %s = ? AND %s = ?",
                            UserScaleModel::Table(),
                            UserScaleModel::PLANNED_GOAL_ONE, UserScaleModel::DEADLINE_GOAL_ONE,
                            UserScaleModel::PLANNED_GOAL_TWO, UserScaleModel::DEADLINE_GOAL_TWO,
                            UserScaleModel::PLANNED_GOAL_THREE, UserScaleModel::DEADLINE_GOAL_THREE,
                            UserScaleModel::USER_ID, UserScaleModel::SCALE_ID);
            
        $stmt = $this->db->prepare($query);
        if (!$stmt->execute([$plannedGoal1, $deadline1,
                             $plannedGoal2, $deadline2,
                             $plannedGoal3, $deadline3,
                             $userID, $scaleID])) {
            throw new Exception(sprintf("Error: unable to update goals for user %d and scale %d", $userID, $scaleID));
        }    
    }

}

?>