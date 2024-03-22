<?php 

class UserScaleModel {
    const ID = "ID";
    const USER_ID = "USER_ID";
    const SCALE_ID = "SCALE_ID";
    const CURRENT_LEVEL = "CURRENT_LEVEL";
    const PLANNED_LEVEL = "PLANNED_LEVEL";
    const PLANNED_GOAL_ONE = "PLANNED_GOAL_1";
    const PLANNED_GOAL_TWO = "PLANNED_GOAL_2";
    const PLANNED_GOAL_THREE = "PLANNED_GOAL_3";
    const DEADLINE_GOAL_ONE = "DEADLINE_GOAL_1";
    const DEADLINE_GOAL_TWO = "DEADLINE_GOAL_2";
    const DEADLINE_GOAL_THREE = "DEADLINE_GOAL_3";

    public static function Table() {
        return "USER_SCALES";
    }
}

?>