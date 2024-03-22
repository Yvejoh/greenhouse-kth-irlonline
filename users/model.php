<?php 

class UserModel {
    const ID = "ID";
    const USERNAME = "EMAIL";
    const PASSWORD = 'PASSWORD';

    public static function Table() {
        return "USERS";
    }
}

?>