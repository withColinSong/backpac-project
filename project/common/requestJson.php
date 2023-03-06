<?php

function responseJson($rtnCode, $message, $success) {
    $arr = array(
        "CODE" => $rtnCode,
        "MESSAGE" => $message,
        "SUCCESS" => $success
    );

    die(json_encode($arr));
}

// 유효성 검사
function issetValidData($requestJson) {

    $requestData = array();
    $success = true;

    foreach ($requestJson as $key => $value) {
        if(!isset($value)) {
            $success = false;
            responseJson("-0001", "data fail", $success);
        }
        $requestData[$key] = addslashes($value);
    }

    return $requestData;
}






