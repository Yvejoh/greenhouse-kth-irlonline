|<?php 

class UserScaleSummary {
    private $scaleID;
    private $scaleTitle;
    private $currentLevel;
    private $plannedLevel;

    public function __construct($scaleID, $scaleTitle, $currentLevel,$plannedLevel) {
        $this->scaleID = $scaleID;
        $this->scaleTitle = $scaleTitle;
        $this->currentLevel = $currentLevel;
        $this->plannedLevel = $plannedLevel;
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

    public function plannedLevel() {
        return $this->plannedLevel;
    }
}

?>