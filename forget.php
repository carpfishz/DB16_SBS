<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>SBS Planner sign up page</title>
    <link rel="stylesheet" href="css/init.css">
    <link rel="stylesheet" href="css/forget.css">
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
        <div id="forgetID-wrapper">
          <form action="forgetID.php" method="POST" id="forgetID_form">
            <input type="text" name="userName" placeholder="input the name" required>
            <input type="email" name="userEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"placeholder="input the email" required>
            <input type="submit" value="find the ID" name="findID" id="find_ID">
          </form>
        </div>
        <div id="forgetPW-wrapper">
          <form action="forgetPW.php" method="POST" id="forgetPW_form">
            <input type="text" name="userId" placeholder="input the id" required>
            <input type="email" name="userEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"placeholder="input the email" required>
            <input type="text" name="userQuestion" placeholder="password question" required>
            <input type="text" name="userAnswer" placeholder="password answer" required>
            <input type="submit" value="find the PW" name="findPW" id="find_PW">
          </form>
        </div>
    </div>
</div>
</body>
</html>
<?php
session_start();
require_once 'class.user.php';
$login = new user();

if($login->is_loggedin()!="") {
    $login->redirection('main.php');
}
?>

