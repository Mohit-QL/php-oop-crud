<?php
class Database
{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    protected function connect()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "oop_crud";

        $conn = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );

        if ($conn->connect_error) {
            die("Database Connection Failed: " . $conn->connect_error);
        }

        return $conn;
    }
}

class Query extends Database
{
    // Get Data
    public function getData($table, $fields)
    {
        $conn = $this->connect();

        $sql = "SELECT $fields FROM `$table`";
        $result = $conn->query($sql);
        return $result;
    }
    
    // Get Data by ID
    public function getDataById($table, $id)
    {
        $conn = $this->connect();
        $sql = "SELECT * FROM `$table` WHERE `id` = $id LIMIT 1";
        $result = $conn->query($sql);
        return ($result && $result->num_rows > 0) ? $result->fetch_assoc() : null;
    }



    // Insert Data
    public function insertData($table, $param)
    {
        $fields = "(" . implode(", ", array_keys($param)) . ")";
        $values = "('" . implode("', '", array_values($param)) . "')";

        $sql = "INSERT INTO `$table` $fields VALUES $values";

        $conn = $this->connect();
        return $conn->query($sql);
    }



    // Update Data
    public function editData($table, $values)
    {
        $conn = $this->connect();

        $id = $values['id'];
        unset($values['id']);

        $setParts = [];
        foreach ($values as $key => $value) {
            $setParts[] = "`$key` = '$value'";
        }
        $setString = implode(", ", $setParts);

        $sql = "UPDATE `$table` SET $setString WHERE `id` = $id";

        return $conn->query($sql);
    }


    // Delete Data
    public function deleteData($table, $id)
    {
        $conn = $this->connect();

        $sql = "DELETE FROM `$table` WHERE `id` = $id";
        return $conn->query($sql);
    }
}
