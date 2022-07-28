<?php

class Database {
    private $host = "localhost:8889";
    private $user = "root";
    private $pass = "root";
    private $db = "vmg-db";

    protected $conn;

    public function __construct()

    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db );

        if (!$this->conn) {
            die("Error, no connection to DB!");
        }

    }
}