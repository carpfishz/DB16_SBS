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
    <link rel="stylesheet" href="css/init.css">
    <link rel="stylesheet" href="css/nanumbarungothic.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/fullcalendar.css">
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <link rel="stylesheet" href="css/fullcalendar.print.css" media='print'>
    <script type="text/javascript" src="js/moment.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/fullcalendar.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

<!--    <script>-->
<!--        $(document).ready(function() {-->
<!--            $('#calendar').fullCalendar({-->
<!--                header: {-->
<!--                    left: 'prev,next today',-->
<!--                    center: 'title',-->
<!--                    right: 'month,basicWeek,basicDay'-->
<!--                },-->
<!--                defaultDate: '2016-09-12',-->
<!--                navLinks: true, // can click day/week names to navigate views-->
<!--                editable: true,-->
<!--                eventLimit: true, // allow "more" link when too many events-->
<!--                events: [-->
<!--                    {-->
<!--                        title: 'All Day Event',-->
<!--                        start: '2016-09-01'-->
<!--                    },-->
<!--                    {-->
<!--                        title: 'Long Event',-->
<!--                        start: '2016-09-07',-->
<!--                        end: '2016-09-10'-->
<!--                    },-->
<!--                    {-->
<!--                        id: 999,-->
<!--                        title: 'Repeating Event',-->
<!--                        start: '2016-09-09T16:00:00'-->
<!--                    },-->
<!--                    {-->
<!--                        id: 999,-->
<!--                        title: 'Repeating Event',-->
<!--                        start: '2016-09-16T16:00:00'-->
<!--                    },-->
<!--                    {-->
<!--                        title: 'Conference',-->
<!--                        start: '2016-09-11',-->
<!--                        end: '2016-09-13'-->
<!--                    },-->
<!--                    {-->
<!--                        title: 'Meeting',-->
<!--                        start: '2016-09-12T10:30:00',-->
<!--                        end: '2016-09-12T12:30:00'-->
<!--                    },-->
<!--                    {-->
<!--                        title: 'Lunch',-->
<!--                        start: '2016-09-12T12:00:00'-->
<!--                    },-->
<!--                    {-->
<!--                        title: 'Meeting',-->
<!--                        start: '2016-09-12T14:30:00'-->
<!--                    },-->
<!--                    {-->
<!--                        title: 'Happy Hour',-->
<!--                        start: '2016-09-12T17:30:00'-->
<!--                    },-->
<!--                    {-->
<!--                        title: 'Dinner',-->
<!--                        start: '2016-09-12T20:00:00'-->
<!--                    },-->
<!--                    {-->
<!--                        title: 'Birthday Party',-->
<!--                        start: '2016-09-13T07:00:00'-->
<!--                    },-->
<!--                    {-->
<!--                        title: 'Click for Google',-->
<!--                        url: 'http://google.com/',-->
<!--                        start: '2016-09-28'-->
<!--                    }-->
<!--                ]-->
<!--            });-->
<!---->
<!--        });-->
<!--    </script>-->
</head>
<body>
    <header id="main_header">
        <div id="logo">
            <h1>SBS Planner</h1>
        </div>
        <div id="logout">
            <a href="logout.php">로그아웃</a>
        </div>
    </header>

    <!-- 테마 선택창 - 제작중 -->
    <div id="myModal" class="modal">
        <form class="modal-content" action="choosetheme.php" id="ct-form" method="POST">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Modal Header</h2>
            </div>
            <div class="modal-body">
                <input type="radio" name="theme" value="1"> White <br />
                <input type="radio" name="theme" value="2"> Black <br />
                <input type="radio" name="theme" value="3"> Green <br />
                <input type="submit" value="확인" name="submit">
            </div>
        </form>
    </div>
    
    <div id="content">
        <aside id="main_aside">
            <div id="profile">profile</div>
            <div id="todayDo">today</div>
            <div id="weekenDo">weeken</div>
        </aside>
        <section id="main_section">
            <div id="calendar">
                <h1>section area</h1>
            </div>
        </section>
    </div>
    <footer id="main_footer">
        <div id="chooseTheme">
            <a href="#" id="ct-button">theme</a>
        </div>
        <div id="notice">
            notice
        </div>
    </footer>
</body>
</html>