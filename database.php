<?php
class Database{
    private $db_host = "127.0.0.1";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "testing";
    private $mysqli = "";
    private $result = array();//Whenever and wherever Sql queries will be executed in our program, result will be stored in this array $result variable.  
    private $conn = false;
    public function __construct(){
        if(!$this->conn){ // Only to store Error.
        $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        $this->conn = true;
            if($this->mysqli->connect_error){
            array_push($this->result, $this->mysqli->connect_error);
            return false; // return false as Connnection Closed/failed.
        }
        else{
            return true; // return true as connection made.
        }
        }
    }
    public function insert($table, $params = array()){

    }
    public function update(){

    }
    public function delete(){


    }
    public function select(){

    }
    public function __destruct(){
    if($this->conn){
        if($this->mysqli->close()){
            $this->conn = false; // 
            return true; // return if Condition as close connection true.
        }
    }
    else{
        return false; // otherwise return false as aleady close connection.
    }
    }
}



?>