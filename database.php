<?php
class Database{
    private $db_host = "127.0.0.1";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "crud_oop";
    private $mysqli = ""; // it is user defined mysqli variable object.
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
            if($this->tableExists($table)){
                $table_columns = implode(' , ', array_keys($params));// Convert array() into string.
                $table_values = implode("' , '", $params);
                $sql = "INSERT INTO $table ($table_columns) VALUES ('$table_values')";
                if($this->mysqli->query($sql)){
                    array_push($this->result, $this->mysqli->insert_id);
                    return true;
                }
                else{
                    array_push($this->result, $this->mysqli->error);
                    return false;
                }

            }
            else{
                return false;
            }

    }
    public function update($table, $params = array(), $where = null){
        if($this->tableExists($table)){
            $args = array();
            foreach($params as $key => $value){
                $args[] = "$key = '$value'"; //agar kisi array men aik sath key & value ko store krna at the same time.
            }
            $sql = "UPDATE $table SET " . implode(",", $args);
            if($where != null){
                $sql .= " WHERE $where"; 
            }
            if($this->mysqli->query($sql)){
                array_push($this->result, $this->mysqli->affected_rows);
            }
            else{
                array_push($this->result, $this->mysqli->error);
            }
            }
        else{
            return false;
        }
    }
    public function delete($table, $where = null){
        if($this->tableExists($table)){
            $sql = "DELETE FROM $table";
            if($where != null){
                $sql .= " WHERE $where";
            }
            if($this->mysqli->query($sql)){
                array_push($this->result, $this->mysqli->affected_rows);
            }
            else{
                array_push($this->result, $this->mysqli->error);
            }

        }
        else{
            return false;
        }
    }
    public function select($table,$rows ="*", $join = null,$where = null, $order = null, $limit = null){
        if($this->tableExists($table)){
            $sql = "SELECT $rows FROM $table";
            if ($join != null){
                $sql .= " JOIN $join";
            }
            if($where != null){
                $sql .= " WHERE $where";
            }
            if($order != null){
                $sql .= " ORDER BY $order";
            }
            if($limit != null){
                if(isset($_GET['page'])){// iF user Clicks on any page number.
                    $page = $_GET['page'];
                }else{
                    $page = 1;
                }
                $start = ($page - 1) * $limit; // start means offset how many records to skip.
                $sql .= " LIMIT $start, $limit ";
            }
            echo $sql; // JUST ECHOING
            $query = $this->mysqli->query($sql);
            if($query){
                $this->result = $query->fetch_all(MYSQLI_ASSOC);
                return true;
            }  
                else{
                    array_push($this->result, $this->mysqli->error);
                }
                }
                else{
                    return false;
                }

    }
    public function pagination($table, $join = null, $where = null, $limit = null){
        if($this->tableExists($table)){
            if($limit != null){
                $sql = "SELECT COUNT(*) FROM $table";  
                if($join != null){
                    $sql .= " JOIN $join";
                }
                if($where != null){
                    $sql .= " WHERE $where";
                }
                $query = $this->mysqli->query($sql);
                $total_record = $query->fetch_array();// Give Number of Rows OR Records.
                $total_record = $total_record[0];
                echo $total_record;
            }
            else{
                return false;
            }

        }else{
            return false;
        }

    }

    public function sql($sql){
      $query = $this->mysqli->query($sql);
      if($query){
        $this->result = $query->fetch_all(MYSQLI_ASSOC);
        return true;
      }  
        else{
            array_push($this->result, $this->mysqli->error);
        }
    }

    private function tableExists($table){
            $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
            $tableInDb = $this->mysqli->query($sql);
            if($tableInDb){
                if($tableInDb->num_rows == 1){
                return true;
            }
            }
            else{
                array_push($this->result,$table."does not found in database");
                return false;
            }

    }
    public function getResult(){
        $val = $this->result;
        $this->result = array();
        return $val;
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