<?php 

require_once("repository.php");

class ScaleService {
    private static $instance;
    private $repository;

    private function __construct() {
        $this->repository = ScaleRepository::get();
    }

    public static function get() {
        if (!isset(self::$instance)) {
            self::$instance = new ScaleService();
        }
        return self::$instance;
    }

    public function findAllIds() {
        $ids = $this->repository->findAllIds();
        if (empty($ids)) {
            die("Error: no preset scales for the user");
        }

        return $ids;
    }


}


?>