|<?php 

class ScaleGoal {
    private $description;
    private $deadline;

    public function __construct($description, $deadline) {
        $this->description = $description;
        $this->deadline = $deadline;
    }

    public function description() {
        return $this->description;
    }

    public function deadline() {
        return $this->deadline;
    }
}

class UserScaleLevel {
    private $scaleID;
    private $level;

    public function __construct($scaleID, $level) {
        $this->scaleID = $scaleID;
        $this->level = $level;
    }

    public function scaleID() {
        return $this->scaleID;
    }

    public function level() {
        return $this->level;
    }
}

class UserScalePlanning {
    private $plannedLevel;
    private $goals;

    public function __construct($plannedLevel, $goals) {
        $this->plannedLevel = $plannedLevel;
        $this->goals = $goals;
    }

    public function plannedLevel() {
        return $this->plannedLevel;
    }

    public function goals() {
        return $this->goals;
    }
}

class UserScale {
    private $scaleID;
    private $scaleTitle;
    private $currentLevel;
    private $scalePlanning;

    public function __construct($scaleID, $scaleTitle, $currentLevel,$scalePlanning) {
        $this->scaleID = $scaleID;
        $this->scaleTitle = $scaleTitle;
        $this->currentLevel = $currentLevel;
        $this->scalePlanning = $scalePlanning;
    }

    public function scaleID() {
        return $this->scaleID;
    }

    public function scaleTitle() {
        return $this->scaleTitle;
    }

    public function currentLevel() {
        return $this->currentLevel; 
    }

    public function planning() {
        return $this->scalePlanning;
    }


}

?>