<?php 

class Scale {
    private $id;
    private $title;
    private $levels;
    
    public function __construct($id, $title, $levels) {
        $this->id = $id;
        $this->title = $title;
        $this->levels = $levels;
    }

    public function getID() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getLevels() {
        return $this->levels;
    }
}

class ScaleLevel {
    private $level;
    private $shortDesc;
    private $fullDesc;

    public function __construct($level, $shortDesc, $fullDesc) {
        $this->level = $level;
        $this->shortDesc = $shortDesc;
        $this->fullDesc = $fullDesc;
    }

    public function getShortDesc() {
        return $this->shortDesc;
    }

    public function getFullDesc() {
        return $this->fullDesc;
    }

    public function getLevel() {
        return $this->level;
    }
}

?>