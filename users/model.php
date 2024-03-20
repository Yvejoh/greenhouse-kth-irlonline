<?php 

class UserModel {
    public static $ID = 'id';
    public static $USERNAME = 'username';
    public static $PASSWORD = 'psswrd';

    public static function Table() {
        return "IRLusers";
    }
}

?>