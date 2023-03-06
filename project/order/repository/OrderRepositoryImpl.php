<?php

include($_SERVER['DOCUMENT_ROOT'] . "/order/repository/OrderRepository.php");
include($_SERVER['DOCUMENT_ROOT'] . "/config/MyPDO.php");

class OrderRepositoryImpl implements OrderRepository {

    private $db;

    public function __construct() {
        $this->db = MyPDO::getInstance();
    }

    function findOrderByUserId($userId) {
        $sql = "SELECT * FROM IDUS_ORDER WHERE USER_ID = '{$userId}'";
        return $this->db->query($sql);
    }

}