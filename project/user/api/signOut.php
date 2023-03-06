<?php

// 로그아웃
if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    session_start();
    $res = session_destroy();
    if ($res) {
        header('Location: /index.php');
    }
}