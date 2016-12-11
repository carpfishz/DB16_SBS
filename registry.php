<?php
session_start();
require_once 'class.user.php';
$user = new user();

if($user->is_loggedin()!="") {
    $user->redirection('main.php');
}

if(isset($_POST['submit'])) {
    $userId = strip_tags($_POST['userId']);
    $userPw = strip_tags($_POST['userPw']);
    $userName = strip_tags($_POST['userName']);
    $userEmail = strip_tags($_POST['userEmail']);
    $userPhone = strip_tags($_POST['userPhone']);
    $userQuestion = strip_tags($_POST['userQuestion']);
    $userAnswer = strip_tags($_POST['userAnswer']);

    $stmt = $user->runQuery("SELECT id, email FROM user WHERE id=:userId OR email=:userEmail");
    $stmt->execute(array(':userId'=>$userId, ':userEmail'=>$userEmail));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['id'] == $userId) {
        //$error[] = "아이디가 이미 사용중 입니다.";
        //echo "<script>alert(\"ID가 이미 사용중 입니다.\");</script>";
        //$user->redirection('signup.php');
        echo "<script>
        alert('ID가 이미 사용중 입니다.');
        window.location.href='signup.php';
        </script>";
    } elseif ($row['email'] == $userEmail) {
        //$error[] = "이메일이 이미 사용중 입니다.";
        //echo "<script>alert(\"E-mail이 이미 사용중 입니다.\");</script>";
        //$user->redirection('signup.php');
        echo "<script>
        alert('E-mail이 이미 사용중 입니다.');
        window.location.href='signup.php';
        </script>";
    } else {
//        if($user->register($userId,$userPw,$userName,$userEmail,$userPhone,$userQuestion,$userAnswer)) {
//            $user->redirection('index.php');
//        }

        $user->register($userId,$userPw,$userName,$userEmail,$userPhone,$userQuestion,$userAnswer);
        $userTheme = 1;
        $stmt2 = $user->runQuery("INSERT INTO theme (id, choosetheme) VALUES (:userId, :userTheme)");
        $stmt2->bindparam("userId", $userId);
        $stmt2->bindparam("userTheme", $userTheme);
        $stmt2->execute();
        $user->redirection('index.php');
    }
} else {
    $user->redirection('signup.php');
}