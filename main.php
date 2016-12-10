<?php
require_once("session.php");
require_once("class.user.php");

$auth_user = new user();
$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM user WHERE id=:userId");
$stmt->execute(array(":userId"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$deleteflag = 0;
$stmt2 = $auth_user->runQuery("SELECT * FROM schedule WHERE id=:userId AND deleteflag=:userDeleteflag");
$stmt2->execute(array(":userId"=>$user_id, ":userDeleteflag"=>$deleteflag));
$events = $stmt2->fetchAll();

$stmt3 = $auth_user->runQuery("SELECT * FROM theme WHERE id=:userId");
$stmt3->execute(array(":userId"=>$user_id));
$skin=$stmt3->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>SBS Planner - welcome - <?php print($userRow['id']); ?></title>
    <link rel="stylesheet" href="css/init.css">
    <link rel="stylesheet" href="css/nanumbarungothic.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fullcalendar.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <style>


    </style>
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

    <!-- Modal -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form class="modal-content" method="POST" action="addEvent.php">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Event</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sc_content" class="col-sm-2 control-label">Content</label>
                    <div class="col-sm-10">
                        <input type="text" name="sc_content" class="form-control" id="sc_content" placeholder="Content">
                    </div>
                </div>
                <div class="form-group">
                    <label for="start" class="col-sm-2 control-label">Start date</label>
                    <div class="col-sm-10">
                        <input type="text" name="start" class="form-control" id="start" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="end" class="col-sm-2 control-label">End date</label>
                    <div class="col-sm-10">
                        <input type="text" name="end" class="form-control" id="end" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="importantlevel" class="col-sm-2 control-label">Important Level</label>
                    <div class="col-sm-10">
                        <select name="importantlevel" class="form-control" id="importantlevel">
                            <option value="">Important level</option>
                            <option value="1">level: 1</option>
                            <option value="2">level: 2</option>
                            <option value="3">level: 3</option>
                            <option value="4">level: 4</option>
                            <option value="5">level: 5</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="repeatflag" class="col-sm-2 control-label">Repeat</label>
                    <div class="col-sm-10">
                        <select name="repeatflag" class="form-control" id="repeatflag">
                            <option value="">repeatflag</option>
                            <option value="1">level: 1</option>
                            <option value="2">level: 2</option>
                            <option value="3">level: 3</option>
                            <option value="4">level: 4</option>
                            <option value="5">level: 5</option>
                        </select>
                    </div>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" value="확인" name="submit" class="btn btn-primary">
            </div>
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--                <input type="submit" value="확인" name="submit" class="btn btn-primary">-->
<!--                        <button type="submit" class="btn btn-primary">Save changes</button>-->
<!--            </div>-->
        </form>
    </div>

    <!-- Modal -->
<!--    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">-->
<!--        <div class="modal-dialog" role="document">-->
<!--            <div class="modal-content">-->
<!--                <form class="form-horizontal" method="POST" action="addEvent.php">-->
<!--                    <div class="modal-header">-->
<!--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
<!--                        <h4 class="modal-title" id="myModalLabel">Add Event</h4>-->
<!--                    </div>-->
<!--                    <div class="modal-body">-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <label for="title" class="col-sm-2 control-label">Title</label>-->
<!--                            <div class="col-sm-10">-->
<!--                                <input type="text" name="title" class="form-control" id="title" placeholder="Title">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="sc_content" class="col-sm-2 control-label">Content</label>-->
<!--                            <div class="col-sm-10">-->
<!--                                <input type="text" name="sc_content" class="form-control" id="sc_content" placeholder="Content">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="start" class="col-sm-2 control-label">Start date</label>-->
<!--                            <div class="col-sm-10">-->
<!--                                <input type="text" name="start" class="form-control" id="start" readonly>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="end" class="col-sm-2 control-label">End date</label>-->
<!--                            <div class="col-sm-10">-->
<!--                                <input type="text" name="end" class="form-control" id="end" readonly>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="importantlevel" class="col-sm-2 control-label">Important Level</label>-->
<!--                            <div class="col-sm-10">-->
<!--                                <select name="importantlevel" class="form-control" id="importantlevel">-->
<!--                                    <option value="">Important level</option>-->
<!--                                    <option value="1">&#9724; level: 1</option>-->
<!--                                    <option value="2">&#9724; level: 2</option>-->
<!--                                    <option value="3">&#9724; level: 3</option>-->
<!--                                    <option value="4">&#9724; level: 4</option>-->
<!--                                    <option value="5">&#9724; level: 5</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="repeatflag" class="col-sm-2 control-label">Repeat</label>-->
<!--                            <div class="col-sm-10">-->
<!--                                <select name="repeatflag" class="form-control" id="repeatflag">-->
<!--                                    <option value="">repeatflag</option>-->
<!--                                    <option value="1">&#9724; level: 1</option>-->
<!--                                    <option value="2">&#9724; level: 2</option>-->
<!--                                    <option value="3">&#9724; level: 3</option>-->
<!--                                    <option value="4">&#9724; level: 4</option>-->
<!--                                    <option value="5">&#9724; level: 5</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="modal-footer">-->
<!--                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--                        <input type="submit" value="확인" name="submit" class="btn btn-primary">-->
<!--                                                <button type="submit" class="btn btn-primary">Save changes</button>-->
<!--                    </div>-->
<!--                </form>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <!-- Modal -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form class="modal-content" method="POST" action="editEventTitle.php">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sc_content" class="col-sm-2 control-label">Content</label>
                    <div class="col-sm-10">
                        <input type="text" name="sc_content" class="form-control" id="sc_content" placeholder="Content">
                    </div>
                </div>
                <div class="form-group">
                    <label for="importantlevel" class="col-sm-2 control-label">Important Level</label>
                    <div class="col-sm-10">
                        <select name="importantlevel" class="form-control" id="importantlevel">
                            <option value="">Important level</option>
                            <option value="1">level: 1</option>
                            <option value="2">level: 2</option>
                            <option value="3">level: 3</option>
                            <option value="4">level: 4</option>
                            <option value="5">level: 5</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="repeatflag" class="col-sm-2 control-label">Repeat</label>
                    <div class="col-sm-10">
                        <select name="repeatflag" class="form-control" id="repeatflag">
                            <option value="">repeatflag</option>
                            <option value="1">level: 1</option>
                            <option value="2">level: 2</option>
                            <option value="3">level: 3</option>
                            <option value="4">level: 4</option>
                            <option value="5">level: 5</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" value="확인" name="submit" class="btn btn-primary">
<!--                <button type="submit" class="btn btn-primary">Save changes</button>-->

                        <input type="hidden" name="idx" class="form-control" id="idx">


            </div>
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--                <button type="submit" class="btn btn-primary">Save changes</button>-->
<!--            </div>-->
        </form>
    </div>

    <!-- Modal -->
<!--    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">-->
<!--        <div class="modal-dialog" role="document">-->
<!--            <div class="modal-content">-->
<!--                <form class="form-horizontal" method="POST" action="editEventTitle.php">-->
<!--                    <div class="modal-header">-->
<!--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
<!--                        <h4 class="modal-title" id="myModalLabel">Edit Event</h4>-->
<!--                    </div>-->
<!--                    <div class="modal-body">-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <label for="title" class="col-sm-2 control-label">Title</label>-->
<!--                            <div class="col-sm-10">-->
<!--                                <input type="text" name="title" class="form-control" id="title" placeholder="Title">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="sc_content" class="col-sm-2 control-label">Content</label>-->
<!--                            <div class="col-sm-10">-->
<!--                                <input type="text" name="sc_content" class="form-control" id="sc_content" placeholder="Content">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="importantlevel" class="col-sm-2 control-label">Important Level</label>-->
<!--                            <div class="col-sm-10">-->
<!--                                <select name="importantlevel" class="form-control" id="importantlevel">-->
<!--                                    <option value="">Important level</option>-->
<!--                                    <option value="1">&#9724; level: 1</option>-->
<!--                                    <option value="2">&#9724; level: 2</option>-->
<!--                                    <option value="3">&#9724; level: 3</option>-->
<!--                                    <option value="4">&#9724; level: 4</option>-->
<!--                                    <option value="5">&#9724; level: 5</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="repeatflag" class="col-sm-2 control-label">Repeat</label>-->
<!--                            <div class="col-sm-10">-->
<!--                                <select name="repeatflag" class="form-control" id="repeatflag">-->
<!--                                    <option value="">repeatflag</option>-->
<!--                                    <option value="1">&#9724; level: 1</option>-->
<!--                                    <option value="2">&#9724; level: 2</option>-->
<!--                                    <option value="3">&#9724; level: 3</option>-->
<!--                                    <option value="4">&#9724; level: 4</option>-->
<!--                                    <option value="5">&#9724; level: 5</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <div class="col-sm-offset-2 col-sm-10">-->
<!--                                <div class="checkbox">-->
<!--                                    <label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="modal-footer">-->
<!--                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--                        <button type="submit" class="btn btn-primary">Save changes</button>-->
<!--                    </div>-->
<!--                </form>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <div id="content">
        <aside id="main_aside">
            <div id="profile">profile</div>
            <div id="todayDo">today</div>
            <div id="weekenDo">weeken</div>
        </aside>
        <section id="main_section">
            <div id="calendar" class="col-centered">
            </div>
        </section>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src='js/moment.min.js'></script>
    <script src='js/fullcalendar.min.js'></script>

    <script>

        $(document).ready(function() {

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultDate: '2016-12-12',
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                selectHelper: true,
                select: function(start, end) {

                    $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd').modal('show');
                },
                eventRender: function(event, element) {
                    element.bind('dblclick', function() {
                        $('#ModalEdit #idx').val(event.idx);
                        $('#ModalEdit #title').val(event.title);
                        $('#ModalEdit #sc_content').val(event.sc_content);
                        $('#ModalEdit #importantlevel').val(event.importantlevel);
                        $('#ModalEdit #repeatflag').val(event.repeatflag);

                        $('#ModalEdit').modal('show');
                    });
                },
                eventDrop: function(event, delta, revertFunc) { // si changement de position

                    edit(event);

                },
                eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

                    edit(event);

                },
                events: [
                    <?php foreach($events as $event):

                    $start = explode(" ", $event['start']);
                    $end = explode(" ", $event['end']);
                    if($start[1] == '00:00:00'){
                        $start = $start[0];
                    }else{
                        $start = $event['start'];
                    }
                    if($end[1] == '00:00:00'){
                        $end = $end[0];
                    }else{
                        $end = $event['end'];
                    }
                    ?>
                    {
                        idx: '<?php echo $event['idx']; ?>',
                        start: '<?php echo $start; ?>',
                        end: '<?php echo $end; ?>',
                        title: '<?php echo $event['title']; ?>',
                        sc_content: '<?php echo $event['content']; ?>',
                        importantlevel: '<?php echo $event['importantlevel']; ?>',
                        deleteflag: '<?php echo $event['deleteflag']; ?>',
                        repeatflag: '<?php echo $event['repeatflag']; ?>',
                    },
                    <?php endforeach; ?>
                ]
            });

            function edit(event){
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                if(event.end){
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');
                }else{
                    end = start;
                }

                idx =  event.idx;

                Event = [];
                Event[0] = idx;
                Event[1] = start;
                Event[2] = end;

                $.ajax({
                    url: 'editEventDate.php',
                    type: "POST",
                    data: {Event:Event},
                    success: function(rep) {
                        if(rep == 'OK'){
                            alert('Saved');
                        }else{
                            alert('Could not be saved. try again.');
                        }
                    }
                });
            }

        });

    </script>

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