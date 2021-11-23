<?php 
  class Post {
    // DB stuff
    private $conn;
    private $table = 'post';

    // Post Properties
    public $username;
    public $email;
    public $password;
    

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT * FROM users';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO users SET username = :username, email = :email, password = :password' ;

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->password = htmlspecialchars(strip_tags($this->password));
          $this->username = htmlspecialchars(strip_tags($this->username));
          $this->email = htmlspecialchars(strip_tags($this->email));
          


          // Bind data
          $stmt-> bindParam(':username', $this->username);
          $stmt-> bindParam(':email', $this->email);
          $stmt-> bindParam(':password', $this->password);
         
          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM users WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }


        public function login() {
          // Create query
          $query = 'SELECT email, password, id, username FROM users WHERE (email = :email AND password = :password)';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(2, $this->email,$this->password);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->email = $row['email'];
          $this->id = $row['id'];
          $this->username = $row['username'];
          $this->password = $row['password'];
    }


    
  }
