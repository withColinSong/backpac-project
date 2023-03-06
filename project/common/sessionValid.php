<?php
session_start();
if(!isset($_SESSION['USER_UID'])) {
    header('Location: ./login.php');
}