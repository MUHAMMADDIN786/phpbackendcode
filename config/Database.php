<?php 
  class Database {
    // DB Params
    // private $host = 'localhost';
    // private $db_name = 'quotesdb';
    // private $username = 'root';
    // private $password = '';
   
    private $url = getenv('postgres://dpckrgufahqgnb:b052b2877672c6b78c47fb442132e38a6b637474b065800f26bfd20a033e6134@ec2-44-194-92-192.compute-1.amazonaws.com:5432/dfegk3gmfbhql0');
    private $dbparts = parse_url($url);
    private $hostname = $dbparts['ec2-44-194-92-192.compute-1.amazonaws.com'];
    private $username = $dbparts['dpckrgufahqgnb'];
    private $password = $dbparts['b052b2877672c6b78c47fb442132e38a6b637474b065800f26bfd20a033e6134'];
    private $database = ltrim($dbparts['dfegk3gmfbhql0'],'/');
    private $conn;

    // DB Connect
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