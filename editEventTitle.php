<?php
require_once("session.php");
require_once("class.user.php");

$auth_user = new user();
$user_id = $_SESSION['user_session'];

if(isset($_POST['submit'])) {
    if(isset($_POST['delete'])) {
        $idx = $_POST['idx'];
        $delete = 1;

        $stmt = $auth_user->runQuery("UPDATE schedule SET deleteflag=:userDeleteflag WHERE id=:userId AND idx=:userIdx");
        $stmt->bindparam("userIdx", $idx);
        $stmt->bindparam("userId", $user_id);
        $stmt->bindparam("userDeleteflag", $delete);
        $stmt->execute();
    } else {
        $idx = $_POST['idx'];
        $title = $_POST['title'];
        $content = $_POST['sc_content'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $importantlevel = $_POST['importantlevel'];
        $repeatflag = $_POST['repeatflag'];

        $stmt = $auth_user->runQuery("UPDATE schedule SET start=:userStart, end=:userEnd, title=:userTitle, content=:userContent, importantlevel=:userImportantlevel, repeatflag=:userRepeatflag WHERE id=:userId AND idx=:userIdx");
        $stmt->bindparam("userIdx", $idx);
        $stmt->bindparam("userId", $user_id);
        $stmt->bindparam("userStart", $start);
        $stmt->bindparam("userEnd", $end);
        $stmt->bindparam("userTitle", $title);
        $stmt->bindparam("userContent", $content);
        $stmt->bindparam("userImportantlevel", $importantlevel);
        $stmt->bindparam("userRepeatflag", $repeatflag);
        $stmt->execute();
    }

    echo "<script>
        alert('일정이 수정되었습니다.');
        window.location.href='main.php';
        </script>";
} else {
    echo "<script>
        alert('main으로 이동');
        window.location.href='main.php';
        </script>";
}


