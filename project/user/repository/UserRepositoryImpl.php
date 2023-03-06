<?php

use entity\User;

include($_SERVER['DOCUMENT_ROOT'] . "/user/repository/UserRepository.php");

class UserRepositoryImpl implements UserRepository {

    private $db;

    public function __construct() {
        $this->db = MyPDO::getInstance();
    }

    function findByUserPhone($phone) {
        $sql = "SELECT PHONE FROM IDUS_USER WHERE PHONE = '{$phone}'";
        return $this->db->query($sql);
    }

    function findByUserEmail($email) {
        $sql = "SELECT EMAIL FROM IDUS_USER WHERE EMAIL = '{$email}'";
        return $this->db->query($sql);
    }

    function findById($id) {
        $sql = "SELECT ID, NAME, NICKNAME, PHONE, EMAIL, GENDER
                FROM IDUS_USER WHERE ID = '{$id}'";
        return $this->db->query($sql);
    }

    function findByUser($email, $password) {
        $sql = "
                SELECT * 
                FROM IDUS_USER
                WHERE EMAIL = '{$email}'
                AND PASSWORD = SHA1('{$password}')
                ";

        return $this->db->query($sql);
    }

    function findAll() {
        $sql = "SELECT * FROM IDUS_USER";
        return $this->db->query($sql);
    }

    function save(User $user) {

        $this->db->beginTransaction();
        $this->db->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);

        if($user->getGender() == '') {
            $sql = "
                    INSERT INTO IDUS_USER (NAME, NICKNAME, PASSWORD, 
                                           PHONE, EMAIL) 
                    VALUES ('{$user->getName()}', '{$user->getNickname()}', SHA1('{$user->getPassword()}'), 
                            '{$user->getPhone()}', '{$user->getEmail()}')
                    ";
        } else {
            $sql = "
                    INSERT INTO IDUS_USER (NAME, NICKNAME, PASSWORD, 
                                           PHONE, EMAIL, GENDER) 
                    VALUES ('{$user->getName()}', '{$user->getNickname()}', SHA1('{$user->getPassword()}'), 
                            '{$user->getPhone()}', '{$user->getEmail()}', '{$user->getGender()}')
                    ";
        }

        if($this->db->query($sql)) {
            $this->db->commit();
        } else {
            $this->db->rollBack();
        }
    }

}