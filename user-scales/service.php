<?php 

require_once("repository.php");

class UserScaleService {
    private static $instance;
    private $repository;

    private function __construct() {
        $this->repository = UserScaleRepository::get();
    }

    public static function get() {
        if (!isset(self::$instance)) {
            self::$instance = new UserScaleService();
        }
        return self::$instance;
    }

    public function getScaleLevel($userID, $scaleID) {
        return $this->repository->getScaleLevel($userID, $scaleID);
    }

    public function updateScaleLevel($userID, $scaleID, $level) {
        $this->repository->updateScaleLevel($userID, $scaleID, $level);
    }

    public function updatePlannedLevel($userID, $scaleID, $level) {
        $this->repository->updatePlannedLevel($userID, $scaleID, $level);
    }

    public function updatePlannedGoals($userID, $scaleID,
                                        $plannedGoal1, $deadline1,
                                        $plannedGoal2, $deadline2,
                                        $plannedGoal3, $deadline3) {
        $this->repository->updatePlannedGoals($userID, $scaleID,
                                            $plannedGoal1, $deadline1,
                                            $plannedGoal2, $deadline2,
                                            $plannedGoal3, $deadline3);
    }

    public function getUserScales($userID) {
        return $this->repository->getUserScales($userID);
    }

    public function getFullUserScales($userID) {
        return $this->repository->getFullUserScales($userID);
    }

    public function getUserScale($userID, $scaleID) {
        return $this->repository->getUserScale($userID, $scaleID);
    }
}


?>