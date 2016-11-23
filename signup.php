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
    <title>SBS Planner sign up page</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/init.css">
    <link rel="stylesheet" href="css/nanumbarungothic.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>
<body>
<form action="registry.php" method="POST" id="signup_form">
    <span>ID</span><input type="text" name="userId" placeholder="아이디" required>
    <span>PW</span><input type="password" name="userPw" placeholder="비밀번호" required>
    <span>Name</span><input type="text" name="userName" placeholder="이름" required>
    <span>E-Mail</span><input type="email" name="userEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="이메일 주소" required>
    <span>Phone</span><input type="text" name="userPhone" pattern="\d{3}[\-]\d{4}[\-]\d{4}" placeholder="전화번호">
    <span>Question</span><input type="text" name="userQuestion" placeholder="아이디, 비밀번호 찾을 질문" required>
    <span>Answer</span><input type="text" name="userAnswer" placeholder="아이디, 비밀번호 찾을 질문 답" required>
    <input type="submit" value="회원가입" name="submit" id="signup_submit">
</form>
</body>
</html>
