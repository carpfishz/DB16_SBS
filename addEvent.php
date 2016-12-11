<?php
require_once("session.php");
require_once("class.user.php");

$auth_user = new user();
$user_id = $_SESSION['user_session'];

if(isset($_POST['submit'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];
    $title = $_POST['title'];
    $content = $_POST['sc_content'];
    $importantlevel = $_POST['importantlevel'];
    $deleteflag = 0;
    $repeatflag = $_POST['repeatflag'];

    $stmt = $auth_user->runQuery("INSERT INTO schedule (id, start, end, title, content, importantlevel, deleteflag, repeatflag) VALUES (:userId, :userStart, :userEnd, :userTitle, :userContent, :userImportantlevel, :userDeleteflag, :userRepeatflag)");
    $stmt->bindparam("userId", $user_id);
    $stmt->bindparam("userStart", $start);
    $stmt->bindparam("userEnd", $end);
    $stmt->bindparam("userTitle", $title);
    $stmt->bindparam("userContent", $content);
    $stmt->bindparam("userImportantlevel", $importantlevel);
    $stmt->bindparam("userDeleteflag", $deleteflag);
    $stmt->bindparam("userRepeatflag", $repeatflag);
    $stmt->execute();

    echo "<script>
        alert('일정이 저장되었습니다.');
        window.location.href='main.php';
        </script>";
} else {
    echo "<script>
        alert('main으로 이동');
        window.location.href='main.php';
        </script>";
}