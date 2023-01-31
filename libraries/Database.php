<?php
class Database
{
    public $db;
    public function __construct()
    {
        $this->db = $this->dbconecttor();
    }


    function dbconecttor()
    {
        //Kết nối tới database
        $servername = "localhost:3305";
        $database = "dbauthentication";
        $usernamedb = "root";
        $passworddb = "Dinhxuan1101@";
        // Create connection
        $conn = mysqli_connect($servername, $usernamedb, $passworddb, $database);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function querySellect($value = [], $table = null, $where = [])
    {
        if ($table && $value) {
            $sql = "SELECT ";
            foreach ($value as $value) {
                $sql .= "{$value}, ";
            }
            $sql = substr($sql, 0, -2);
            $sql .= " FROM {$table} ";
            if($where){
                $sql .="WHERE ";
                foreach ($where as $key => $value) {
                    $sql .= "{$key} = {$value} AND ";
                }
                $sql = substr($sql, 0, -4);
            }
            $query = mysqli_query($this->db, $sql);
            $row = mysqli_fetch_all($query,MYSQLI_ASSOC);
            return $row;

        }
    }
    function queryInsert($value = [], $where = [])
    {
        if ($where && $value) {
            $sql = "INSERT INTO ";
            foreach ($where as $where) {
                $sql .= "{$where}, ";
            }
            $sql = substr($sql, 0, -2);
            $sql .= " VALUES (";
            foreach ($value as $value) {
                $sql .= "{$value}, ";
            }
            $sql = substr($sql, 0, -2);
            $sql .= ")";
            mysqli_query($this->db, $sql);
        }
    }
    function queryUpdate($value = [], $table = null, $where = [])
{
    $sql = "UPDATE {$table} SET ";
    foreach ($value as $key => $value) {
        $sql .= "{$table}.{$key}={$value}, ";
    }
    $sql = substr($sql, 0, -2);
    $sql .= " WHERE ";
    foreach ($where as $key => $where) {
        $sql .= "{$table}.{$key}={$where} AND ";
    }
    $sql = substr($sql, 0, -4);
    mysqli_query($this->db, $sql);
}

    public function __destruct()
    {
        mysqli_close($this->db);
    }
}
