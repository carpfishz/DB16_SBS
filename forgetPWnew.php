
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>SBS Planner sign up page</title>
    <link rel="stylesheet" href="css/init.css">
    <link rel="stylesheet" href="css/forgetPWnew.css">
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
          <form action="forgetPWupdate.php" method="POST" id="forgetPWnew_form">
            <input type="password" name="userPw" placeholder="input the password" required>
            <input type="password" name="userPw2" placeholder="input the password one more" required>
            <input type="submit" value="change" name="chPW" id="ch_PW">
          </form>
    </div>
</div>
</body>
</html>
