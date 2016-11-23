<?php
require_once 'session.php';
require_once 'class.user.php';

$user_logout = new user();
$user_logout->doLogout();
$user_logout->redirection('index.php');