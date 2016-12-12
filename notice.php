<?php
require_once 'class.user.php';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
    <title>SBS Planner - welcome -</title>
    <link rel="stylesheet" href="css/init.css">
    <link rel="stylesheet" href="css/nanumbarungothic.css">
    <link rel="stylesheet" href="css/notice.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fullcalendar.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
<table border=1 cellspacing=0 width=800 bordercolordark=white bordercolorlight=#999999>

    <tr>
        <td width=30 bgcolor=#CCCCCC>
            <p align=center>no</p>
        </td>
        <td whdth=150 bgcolor=#CCCCCC>
            <p align=center>title</p>
        </td>
        <td width=450 bgcolor=#CCCCCC>
            <p align=center>content</p>
        </td>
        <td width=160 bgcolor=#CCCCCC>
            <p align=center>date</p>
        </td>
    </tr>

<?php
$user = new user();

$stmt = $user->runQuery("select * from notice order by idx=:idx");
$stmt->execute(array(":idx"=>$idx));
//$row=$stmt->fetch(PDO::FETCH_ASSOC);


while($array=$stmt->fetch(PDO::FETCH_ASSOC)) {
echo "
    <tr>
        <td width=30>
            <p align=center>".$array['idx']."</p>
        </td>
        <td width=150>
            <p align=center>".$array['title']."</p>
        </td>
        <td width=450>
            <p align=center>".$array['content']."</p>
        </td>
        <td width=160>
            <p align=center>".$array['writetime']."</p>
        </td>
    </tr>";}
?>
</table>
</body>
</html>
