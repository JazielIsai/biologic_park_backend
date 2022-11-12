<?php

class DBCnx {

    private string $host;
    private string $user;
    private string $password;
    private string $charset ='utf8mb4';
    private string $db;

    public function __construct($db) {

        $file = "configuration.ini";
        if ( !$file = parse_ini_file($file, true) ){
            echo "File wasn't able to open";
        }

        $this->host = $file['database_biologic_park']['host'];
        $this->user = $file['database_biologic_park']['username'];
        $this->password = $file['database_biologic_park']['password'];
        $this->db = $db;

    }

    protected function Connection () {
       try {
           $cnx = "mysql:host=".$this->host.";dbname=".$this->db;
           return new PDO($cnx, $this->user, $this->password);

       } catch (PDOException $err) {
           print "Error DB!: " . $err->getMessage() . "<br/>";
           die();
       }
    }

}