<?php 
  class User {
    // DB stuff
    private $conn;

    // User Properties
    public $username;
    public $email;
    public $password;
    public $phoneNumber;
    public $location;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get users
    public function read() {
      // Create query
      $query = 'SELECT * FROM users';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Create user
    public function create() {
          // Create query
          $query = 'INSERT INTO users SET username = :username, email = :email, password = :password, phoneNumber= :phoneNumber, location= :location' ;

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->password = htmlspecialchars(strip_tags($this->password));
          $this->username = htmlspecialchars(strip_tags($this->username));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->phoneNumber = htmlspecialchars(strip_tags($this->phoneNumber));
          $this->location = htmlspecialchars(strip_tags($this->location));



          // Bind data
          $stmt-> bindParam(':username', $this->username);
          $stmt-> bindParam(':email', $this->email);
          $stmt-> bindParam(':password', $this->password);
         $stmt-> bindParam(':phoneNumber', $this->phoneNumber);
        $stmt-> bindParam(':location', $this->location);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Delete user
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
           $query = 'SELECT * FROM users WHERE (email = :email AND password = :password)';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind Params
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':password',$this->password);
          // Execute query
          $stmt->execute();
          
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          if ($row['id']!= null ){
          // Set properties
          $this->email = $row['email'];
          $this->password = $row['password'];
          $this->id = $row['id'];
          $this->username = $row['username'];
          $this->phoneNumber = $row['phoneNumber'];
          $this->location = $row['location'];}
          else{
            http_response_code(404);
          }

        }
    
  }
