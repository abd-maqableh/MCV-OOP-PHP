<?php


class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $mydb = "store";
    private $password = "";

    function connect()
    {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->mydb", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //  echo "Connected successfully";
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: <br> " . $e->getMessage();
        }
    }
}