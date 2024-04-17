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

    public function ID() {
        return $this->id;
    }

    public function title() {
        return $this->title;
    }

    public function levels() {
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

    public function shortDesc() {
        return $this->shortDesc;
    }

    public function fullDesc() {
        return $this->fullDesc;
    }

    public function level() {
        return $this->level;
    }
}

?>