<?php

class Database
{
    //Database Parameter
    private $host       = 'localhost';
    private $db_name    = 'db_email';
    private $username   = 'postgres';
    private $password   = 'admin';
    private $conn;

    public function connect()
    {   
        $this->conn = null;

        try {
            $this->conn = new PDO("pgsql:host=".$this->host.";dbname=".$this->db_name. ";user=".$this->username . ";password=".$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOexception $e) {
            echo 'Connection Error: '. $e->getMessage();
        }

        return $this->conn;
    }
}
