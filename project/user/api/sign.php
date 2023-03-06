<?php

use entity\User;

include($_SERVER['DOCUMENT_ROOT'] . "/user/repository/UserRepositoryImpl.php");
include($_SERVER['DOCUMENT_ROOT'] . "/user/inc/include.php");

$method = $_SERVER['REQUEST_METHOD'];
$action = $_REQUEST['ACTION'];

$userRepositoryImpl = new UserRepositoryImpl();

if($method == 'POST') {
    if (isset($action)) {
        $action = $_POST['ACTION'];

        switch ($action) {
            case "REGISTER_USER" :      // 회원가입

                $sendObject = $_REQUEST['PAYLOAD'];
                $requestJson = json_decode($sendObject);
                $gender = addslashes($requestJson->GENDER);

                $success = true;
                $requestData = array();

                // 유효성 검사
                foreach ($requestJson as $key => $value) {
                    if(!isset($value)) {
                        $success = false;
                        responseJson("-0001", "data fail", $success);
                    }
                    $requestData[$key] = addslashes($value);
                }

                try {

                    UserValidCheck::nameValid($requestData['NAME']);
                    UserValidCheck::nicknameValid($requestData['NICKNAME']);
                    UserValidCheck::passwordValid($requestData['PASSWORD']);
                    UserValidCheck::phoneValid($requestData['PHONE']);
                    UserValidCheck::emailValid($requestData['EMAIL']);

                } catch (Exception $e) {
                    $success = false;
                    responseJson($e->getCode(), $e->getMessage(), $success);
                }

                $user = User::of($requestData);

                $existUserPhoneCnt = $userRepositoryImpl->findByUserPhone($user->getPhone())->rowCount();
                $existUserEmailCnt = $userRepositoryImpl->findByUserEmail($user->getEmail())->rowCount();

                if($existUserPhoneCnt > 0 || $existUserEmailCnt > 0) {
                    // 이미 회원
                    $success = false;
                    responseJson("exists user", "-0002", $success);
                } else {
                    // 회원가입
                    try {
                        $userRepositoryImpl->save($user);
                    } catch (PDOException $e) {
                        $success = false;
                        responseJson($e->getCode(), $e->getMessage(), $success);
                    }

                    responseJson("success", "0000", $success);

                }

                break;

            case "SIGN_UP"  :      // 로그인

                session_start();
                $sendObject = $_REQUEST['PAYLOAD'];
                $requestJson = json_decode($sendObject);

                $success = true;
                $requestData = array();

                $issetValidData = issetValidData($requestJson);
                $userInfo = $userRepositoryImpl->findByUser($issetValidData['EMAIL'], $issetValidData['PASSWORD']);
                $userCnt =  $userInfo->rowCount();

                if($userCnt > 0) {
                    $users = $userInfo->fetch();
                    // 로그인
                    $_SESSION['USER_UID']   = $users->ID;
                    $_SESSION['USER_EMAIL'] = $users->EMAIL;
                    responseJson("success", "0000", $success);
                } else {
                    // 로그인 실패
                    $success = false;
                    responseJson("login fail", "-0003", $success);
                }

                break;

        }
    }

}