<?php

require_once("scales/service.php");
require_once("user-scales/service.php");
require_once("sql/db.php");
require_once("repository.php");

class UserService {
    private static $instance;
    private $scaleService;
    private $repository;

    private function __construct() {
        $this->scaleService = ScaleService::get();
        $this->repository = UserRepository::get();
    }

    public static function get() {
        if (!isset(self::$instance)) {
            self::$instance = new UserService();
        }
        return self::$instance;
    }

    public function createUser($username, $password) {
        try {
            $scaleIds = $this->scaleService->findAllIds();
             return $this->repository->create($username,$password, $scaleIds);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function findByUsername($username) {
        return $this->repository->findByUsername($username);
    }

    public function isValidPassword($username, $password) {
        $user =  $this->repository->findByUsername($username);
        if ($user != NULL) {
            return  password_verify($user->password(),$password);
        }

        return false;
    }


    public function updatePassword($username,$password) {
        $id = $this->db->findByUserName($username);
        if ($id == NULL) {
            die("Unknown username");
        }

        $this->repository->updatePassword($id, $password);
    }
}


?>