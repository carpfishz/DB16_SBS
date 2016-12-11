<?php
class Database
{
    private $host = "localhost";
    private $db_name = "db_sbs";
    private $username = "sbs";
    private $password = "db12345";
    public $conn;

    public function dbConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

//$servername = "localhost";
//$username = "sbs";
//$password = "db12345";
//
//try {
//    $conn = new PDO("mysql:host=$servername;dbname=db_sbs", $username, $password);
//    // set the PDO error mode to exception
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//}  catch(PDOException $e)  {
//    echo "Connection failed: " . $e->getMessage();
//}
//
//include_once 'class.user.php';
//$user = new user($conn);