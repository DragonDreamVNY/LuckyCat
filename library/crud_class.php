<?php
class Crud
{
    //crud class
    public $conn;
    private $host = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "luckycat";

    function __construct(){
        $this->database_connect();
    }


    public function database_connect(){

        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
    }

    public function execute_query($query){
        return mysqli_query($this->conn,$query);
    }

} //end class


?>