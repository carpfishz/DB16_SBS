<?php
require_once("session.php");
require_once("class.user.php");

$auth_user = new user();
$user_id = $_SESSION['user_session'];

//if(isset($_POST['submit'])) {
if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])) {
    $idx = $_POST['Event'][0];
    $start = $_POST['Event'][1];
    $end = $_POST['Event'][2];

    $stmt = $auth_user->runQuery("UPDATE schedule SET start=:userStart, end=:userEnd WHERE id=:userId AND idx=:userIdx");
    $stmt->bindparam("userIdx", $idx);
    $stmt->bindparam("userId", $user_id);
    $stmt->bindparam("userStart", $start);
    $stmt->bindparam("userEnd", $end);
    $stmt->execute();

    die('OK');
//    echo "<script>
//        alert('시간이 변경 되었습니다.');
//        window.location.href='main.php';
//        </script>";
//} else {
//    echo "<script>
//        alert('main으로 이동');
//        window.location.href='main.php';
//        </script>";
//}

} else {
    echo "<script>
        alert('main으로 이동');
        window.location.href='main.php';
        </script>";
}