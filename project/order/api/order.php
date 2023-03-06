<?php

include($_SERVER['DOCUMENT_ROOT'] . "/common/requestJson.php");
include($_SERVER['DOCUMENT_ROOT'] . "/order/repository/OrderRepositoryImpl.php");

$method = $_SERVER['REQUEST_METHOD'];
$action = $_REQUEST['ACTION'];

$orderRepositoryImpl = new OrderRepositoryImpl();
if ($method == 'GET') {
    if (isset($action)) {
        $action = $_GET['ACTION'];

        switch ($action) {
            case "GET" :      // 단일 회원의 주문 목록 조회

                $success = true;
                $userId = base64_decode($_REQUEST['NUM']);
                $OrderInfo = $orderRepositoryImpl->findOrderByUserId($userId);

                if($OrderInfo->rowCount() > 0) {
                    responseJson("success", $OrderInfo->fetch(), $success);
                } else {
                    $success = false;
                    responseJson("-1200", "fail", $success);
                }

                break;
        }
    }
}
