<?php

// ๋ก๊ทธ์์
if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    session_start();
    $res = session_destroy();
    if ($res) {
        header('Location: /index.php');
    }
}