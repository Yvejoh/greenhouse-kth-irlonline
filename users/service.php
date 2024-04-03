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
        $this->checkUsername($username);
        $this->checkPassword($password);

        $scaleIds = $this->scaleService->getIds();
        return $this->repository->create($username,password_hash($password, PASSWORD_BCRYPT), $scaleIds);
    }

    public function login($username, $password){
        $user = $this->repository->findByUsername($username);
        if ($user == NULL || !password_verify($password, $user->password())) {
            throw new InvalidCredentialsException("Invalid unsername or password!");
        }
    }
    
    public function findByUsername($username)  {
        
        return $this->repository->findByUsername($username);
    }

    public function isUserPassword($username, $password) {


        return false;
    }
    
    public function updatePassword($username,$password) {
        $id = $this->repository->findByUserName($username);
        if ($id == NULL) {
            throw new InvalidUsernameException("Invalid username");
        }

        if ($this->checkPassword($password)) {
            $this->repository->updatePassword($id, password_hash($password, PASSWORD_BCRYPT));
        }
    }


    private function checkUsername($username) {
        if ($this->findByUsername($username) != NULL) {
            throw new InvalidUsernameException("Username already exists");
        }

        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidUsernameException("Invalid username format!");
        }
    }

    private function checkPassword($password) {
        if (strlen($password) < 6) {
            throw new InvalidPasswordException("Password must be at least 6 characters long!");
        }

        if (!preg_match("#[0-9]+#", $password)) {
            throw new InvalidPasswordException("Password must include at least one number!");
        }

        if (!preg_match("#[a-zA-Z]+#", $password)) {
            throw new InvalidPasswordException("Password must include at least one letter!");
        }   
    }


}


?>