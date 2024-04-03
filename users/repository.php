<?php

require_once("user-scales/repository.php");
require_once("sql/db.php");
require_once("model.php");
require_once("user.php");

class UserRepository {
    private static $instance;
    private $userScaleRepository;
    private $db;

    private function __construct() {
        $this->db = DB::get();
        $this->userScaleRepository = UserScaleRepository::get();
    }

    public static function get() {
        if (!isset(self::$instance)) {
            self::$instance = new UserRepository();
        }
        return self::$instance;
    }

    public function findByUsername($username) {
        $query = sprintf("SELECT * FROM %s WHERE %s=?", UserModel::Table(), UserModel::USERNAME);
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        if ($stmt->rowCount() != 0) {
            $row = $stmt->fetch();
            return new User($row[UserModel::ID],
                            $row[UserModel::USERNAME],
                            $row[UserModel::PASSWORD]);
        }
        return NULL;
    }

    public function create($username, $password, $scaleIds) {
        $query = sprintf("INSERT INTO %s(%s,%s) VALUES(?,?)",  UserModel::Table(), UserModel::USERNAME, UserModel::PASSWORD);
        
        $this->db->beginTransaction();
        if(!$this->db->prepare($query)->execute([$username, $password])) {
            throw new Exception("Error: Could not create user");
        }

        $userID = $this->db->lastInsertId();
        try {
            foreach ($scaleIds as $key => $scaleId) {
                $this->userScaleRepository->create($userID,$scaleId);
            }
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollback();
            throw $e;
        }

        return $userID;
    }


    public function updatePassword($userID, $password) {
        $query = sprintf("UPDATE %S SET %s = ? WHERE %s = ?", UserModel::Table(), UserModel::ID, UserModel::PASSWORD);
        if(!$this->db->prepare($query)->execute([$userID, $password])) {
            throw new Exception(sprintf("Error: Could not update password for user %s", $userID));
        }
    }
}

?>