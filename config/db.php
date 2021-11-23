<?php
class Database {
    //DB params
    private $host = 'bn4mk3airl4qaeevh9is-mysql.services.clever-cloud.com';
    private $db_name ='bn4mk3airl4qaeevh9is';
    private $username ='u7pabhpjs7lnhwdz';
    private $password ='BCXrHu4MqhkTwX7xAoAq';
    private $conn;
    //DB connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
}