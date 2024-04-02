<?php

require_once("scales/service.php");
require_once("user-scales/service.php");
require_once("exceptions.php");
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
        if ($this->findByUsername($username)) {
            throw new UnavailableUsernameException("Username already exists");
        }

        $scaleIds = $this->scaleService->getIds();
        return $this->repository->create($username,$password, $scaleIds);
    }

    public function findByUsername($username) {
        return $this->repository->findByUsername($username);
    }

    public function isUserPassword($username, $password) {
        $user =  $this->repository->findByUsername($username);
        if ($user != NULL) {
            return password_verify($user->password(),$password);
        }

        return false;
    }
    
    public function updatePassword($username,$password) {
        $id = $this->db->findByUserName($username);
        if ($id == NULL) {
            throw new UnknownUserException("Invalid username");
        }

        $this->repository->updatePassword($id, $password);
    }

    private function checkPassword($password) {
        if (strlen($pwd) < 6) {
            throw new InvalidPasswordException("Password must be at least 6 characters long!");
        }

        if (!preg_match("#[0-9]+#", $pwd)) {
            throw new InvalidPasswordException("Password must include at least one number!");
        }

        if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            throw new InvalidPasswordException("Password must include at least one letter!");
        }   
    }


}


?>