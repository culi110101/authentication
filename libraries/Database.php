<?php
class Database {
    public $db;
    public function __construct()
    {
        $this->db = $this->dbconecttor();
    }

    
    function dbconecttor()
    {
        //Kết nối tới database
        $servername = "localhost:3305";
        $database = "dbtest";
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
        if ($table && $where && $value) {
            $sql = "SELECT ";
            foreach ($value as $value) {
                $sql .= "{$value}, ";
            }
            $sql = substr($sql, 0, -2);
            $sql .= " FROM {$table} WHERE ";

            foreach ($where as $key => $value) {
                $sql .= "{$key} = {$value} AND ";
            }
            $sql = substr($sql, 0, -4);
            $query = mysqli_query($this->db, $sql);
            $row = mysqli_fetch_array($query);
            return $row;
        }
    }

    public function __destruct()
    {
        mysqli_close($this->db);
    }
}