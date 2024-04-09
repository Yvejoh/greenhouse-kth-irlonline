<?php 

require_once ('sql/db.php');
require_once("model.php");
require_once("scale.php");

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

    public function findByID($scaleID) {
        $levels = $this->findScaleLevels($scaleID);
        if (count($levels) == 0) {
            return NULL;
        }

        $query = sprintf("SELECT %s,%s FROM %s WHERE %s=?", ScaleModel::ID,ScaleModel::TITLE, ScaleModel::Table(), ScaleModel::ID);
        $stmt = $this->db->prepare($query);
        if (! $stmt->execute([$scaleID])) {
            throw new DBException(sprintf("Unable to fetch scale with id %d", $scaleID));
        }

        if ($stmt->rowCount() == 0) {
            return NULL;
        }

        $row = $stmt->fetch();
        return new Scale($row[ScaleModel::ID], $row[ScaleModel::TITLE], $levels);
    }
        
    public function getIds() {
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

    private function findScaleLevels($scaleID) {
        $query = sprintf("SELECT %s,%s,%s FROM %s WHERE %s = ?",
                            ScaleLevelModel::LEVEL,
                            ScaleLevelModel::SHORT_DESC,
                            ScaleLevelModel::FULL_DESC,
                            ScaleLevelModel::Table(),
                            ScaleLevelModel::SCALE_ID);
        $stmt =  $this->db->prepare($query);
        if (!$stmt->execute([$scaleID])) {
            throw new DBException(sprintf("Unable to fetch scale levels for scale %d", $scaleID));
        }

        $rows =  $stmt->fetchAll();
        $levels = array();
        foreach ($rows as $row) {
            array_push($levels, new ScaleLevel($row[ScaleLevelModel::LEVEL],
                                               $row[ScaleLevelModel::SHORT_DESC],
                                               $row[ScaleLevelModel::FULL_DESC]));
        }
        return $levels;                        
    }
}

?>