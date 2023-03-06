<?php

class MyPDO {
    protected static $instance;

    public function __construct() { }

    public static function getInstance() {

        $dbInfo = array(
            "serverName" => "localhost",
            "dbname" => "IDUS",
            "user" => "song",
            "password" => "",
        );

        if(empty(self::$instance)) {
            try {
                self::$instance = new PDO("mysql:host={$dbInfo['serverName']};dbname={$dbInfo['dbname']}", $dbInfo['user'], $dbInfo['password']);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$instance->query('SET NAMES utf8');
                self::$instance->query('SET CHARACTER SET utf8');

            } catch(PDOException $e) {
                die($e -> getMessage());
            }
        }

        return self::$instance;
    }

}
