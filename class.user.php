<?php

require_once 'db_connect.php';

class user {
    private $conn;

//    public function __construct($db_conn){
//        $this->conn = $db_conn;
//    }

    public function __construct() {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function register($userId, $userPw, $userName, $userEmail, $userPhone, $userQuestion, $userAnswer) {
        try {
            $hashPassword = password_hash($userPw, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("INSERT INTO user(id, pw, name, email, phone, question, answer) VALUES(:userId, :userPw, :userName, :userEmail, :userPhone, :userQuestion, :userAnswer)");
            $stmt->bindparam(":userId", $userId);
            $stmt->bindparam(":userPw", $hashPassword);
            $stmt->bindparam(":userName", $userName);
            $stmt->bindparam(":userEmail", $userEmail);
            $stmt->bindparam(":userPhone", $userPhone);
            $stmt->bindparam(":userQuestion", $userQuestion);
            $stmt->bindparam(":userAnswer", $userAnswer);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function doLogin($userId, $userEmail, $userPw) {
        try {
            $stmt = $this->conn->prepare("SELECT id, pw, name FROM user WHERE id=:userId OR email=:userEmail");
            $stmt->execute(array(':userId'=>$userId, ':userEmail'=>$userEmail));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() == 1) {
                if(password_verify($userPw, $userRow['pw'])) {
                    $_SESSION['user_session'] = $userRow['id'];
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function is_loggedin() {
        if(isset($_SESSION['user_session'])) {
            return true;
        }
    }
    
    public function redirection($url) {
        header("Location: $url");
    }

    public function doLogout() {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }
}