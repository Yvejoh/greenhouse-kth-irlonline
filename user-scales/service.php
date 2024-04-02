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

    public function getUserScales($userID) {
        return $this->repository->getUserScales($userID);
    }
}


?>