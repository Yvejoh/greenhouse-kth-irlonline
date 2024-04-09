<?php 

require_once("repository.php");

class ScaleService {
    private static $instance;
    private $repository;

    public static function get() {
        if (!isset(self::$instance)) {
            self::$instance = new ScaleService();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->repository = ScaleRepository::get();
    }

    public function findByID($scaleID) {
        $scale = $this->repository->findByID($scaleID);
        if ($scale == NULL) {
            die("No scale");
        }

        return $scale;
    }

    public function getIds() {
        $ids = $this->repository->getIds();
        if (empty($ids)) {
            die("Error: no preset scales for the user");
        }

        return $ids;
    }


}


?>