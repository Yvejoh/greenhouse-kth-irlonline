<?php 

class ScaleModel {
    const ID = "ID";
    const TITLE = "TITLE";

    public static function Table() {
        return "SCALES";
    }
}

class ScaleLevelModel {
    const SCALE_ID = "SCALE_ID";
    const LEVEL = "LEVEL";
    const SHORT_DESC = "SHORT_DESC";
    const FULL_DESC = "FULL_DESC";

    public static function Table() {
        return "SCALE_LEVELS";
    }
}
?>