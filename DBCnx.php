<?php

class DBCnx {

    private string $host='localhost';
    private string $user='root';
    private string $password='root123';
    private string $charset ='utf8mb4';
    private string $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function Connection () {
       try {
           $cnx = "mysql:host=".$this->host.";dbname=".$this->db;
           return new PDO($cnx, $this->user, $this->password);

       } catch (PDOException $err) {
           print "Error DB!: " . $err->getMessage() . "<br/>";
           die();
       }
    }

}