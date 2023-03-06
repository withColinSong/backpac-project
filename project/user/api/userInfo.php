<?php

use entity\Page;

include($_SERVER['DOCUMENT_ROOT'] . "/user/inc/include.php");
include($_SERVER['DOCUMENT_ROOT'] . "/user/repository/AdminRepositoryQueryImpl.php");
include($_SERVER['DOCUMENT_ROOT'] . "/user/repository/UserRepositoryImpl.php");

$userRepositoryImpl = new UserRepositoryImpl();
$AdminRepository = new AdminRepositoryQueryImpl();

$method = $_SERVER['REQUEST_METHOD'];
$action = $_REQUEST['ACTION'];

if($method == 'GET') {
    if (isset($action)) {
        $action = $_GET['ACTION'];

        switch ($action) {
            case "GET" :      // 단일 회원 상세 정보 조회

                // base64로 $_REQUEST['NUM'] userId 인코딩으로 전달받았을 때 가정
                $success = true;
                $userId = base64_decode($_REQUEST['NUM']);

                $userInfo = $userRepositoryImpl->findById($userId);
                if($userInfo->rowCount() > 0) {
                    responseJson("success", $userInfo->fetch(), $success);
                } else {
                    $success = false;
                    responseJson("-1100", "fail", $success);
                }

                break;

            case "ALL" :      // 여러 회원 목록 조회

                $page = addslashes($_GET['PAGE']);
                $name = addslashes($_GET['NAME']);
                $email = addslashes($_GET['EMAIL']);
                if(!isset($_GET['page'])) $page = 1;

                $pdo = MyPDO::getInstance();

                $sql = $AdminRepository->findAllSubQueryLastOrderItem();
                $totalCount = $pdo->query($sql)->rowCount();

                $pageSize = 15;
                $blockNum = 5;
                $limit = ($page - 1) * $pageSize;

                $page = new Page();
                $pageInfo = $page->setPaging($totalCount, $page, $pageSize, $blockNum);

                if(!empty($name))  {
                    $sql .= $AdminRepository->andName($name);
                }

                if(!empty($email)) {
                    $sql .= $AdminRepository->andEmail($email);
                }

                $sql .= $AdminRepository->limit($limit, $pageSize);
                $success = true;

                $userInfo = $pdo->query($sql)->fetchAll();

                $responseData = array(
                    "userInfo" => $userInfo,
                    "page" => $pageInfo
                );

                responseJson("success", $responseData, $success);

                break;

        }
    }
}