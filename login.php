<?php
session_start();
require_once 'class.user.php';
$login = new user();

if($login->is_loggedin()!="") {
    $login->redirection('main.php');
}

if(isset($_POST['submit'])) {
    $userId = strip_tags($_POST['userEmail']);
    $userEmail = strip_tags($_POST['userEmail']);
    $userPw = strip_tags($_POST['userPw']);

    if($login->doLogin($userId,$userEmail,$userPw)) {
        $login->redirection('main.php');
    } else {
        $error = "fail";
        $login->redirection('index.php');
    }
} else {
    $login->redirection('index.php');
}