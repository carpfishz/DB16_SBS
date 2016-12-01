<?php
require_once("session.php");
require_once("class.user.php");

$auth_user = new user();
$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM user WHERE id=:userId");
$stmt->execute(array(":userId"=>$user_id));

$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>SBS Planner - welcome - <?php print($userRow['id']); ?></title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/init.css">
    <link rel="stylesheet" href="css/nanumbarungothic.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>
<body>
    <header>
        <div id="logo">
            <h1>SBS Planner</h1>
        </div>
        <div id="logout">
            <a href="logout.php">로그아웃</a>
        </div>
    </header>
    <aside>
        <div id="profile"></div>
        <div id="todayDo"></div>
        <div id="weekenDo"></div>
    </aside>
    <section>
        <div>

        </div>
    </section>
    <footer>
        <div id="chooseTheme">

        </div>
        <div id="notice">

        </div>
    </footer>
</body>
</html>