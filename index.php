<?php
session_start();
require_once 'class.user.php';
$login = new user();

if($login->is_loggedin()!="") {
    $login->redirection('main.php');
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>SBS Planner</title>
    <link rel="stylesheet" href="css/init.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/nanumbarungothic.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>
<body>
<div id="wrapper">
    <div id="image-wrapper">
        <h1>
            <a href="/sbs">SBS Planner</a>
        </h1>
    </div>
    <div id="form-wrapper">
        <form action="login.php" method="POST" id="login_form">
            <input type="text" name="userEmail" placeholder="아이디 또는 이메일 주소" required>
            <input type="password" name="userPw" placeholder="비밀번호" required>
            <input type="submit" value="로그인" name="submit" id="login_submit">
        </form>
    </div>
</div>
</body>
</html>