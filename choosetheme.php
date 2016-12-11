<?php
require_once("session.php");
require_once("class.user.php");

$auth_user = new user();
$user_id = $_SESSION['user_session'];

if(isset($_POST['submit'])) {
    $user_Theme = $_POST['theme'];
    $stmt = $auth_user->runQuery("UPDATE theme SET choosetheme=:userTheme WHERE id=:userId");
    $stmt->bindparam(":userTheme", $user_Theme);
    $stmt->bindparam("userId", $user_id);
    $stmt->execute();

    echo "<script>
        alert('테마가 변경되었습니다.');
        window.location.href='main.php';
        </script>";
//    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "<script>
        alert('main으로 이동');
        window.location.href='main.php';
        </script>";
}