<?php
session_start();

require_once 'class.user.php';
$session = new user();

if(!$session->is_loggedin()) {
    $session->redirection('index.php'); //session 없으면 index.php
}