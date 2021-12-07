<?php 
  class Post {
    // DB stuff
    private $conn;
    private $table = 'post';

    // Post Properties
    public $title;
    public $type;
    public $imagePath;
    public $date;
    public $location;
    public $description;
    public $id_user;
    public $phoneNumber;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT * FROM posts';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO posts SET title = :title, type = :type, description = :description, location = :location, date = :date, imagePath = :imagePath, id_user = :id_user, phoneNumber= :phoneNumber';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->type = htmlspecialchars(strip_tags($this->type));
          $this->description = htmlspecialchars(strip_tags($this->description));
          $this->location = htmlspecialchars(strip_tags($this->location));
          $this->date = htmlspecialchars(strip_tags($this->date));
          $this->imagePath = htmlspecialchars(strip_tags($this->imagePath));
          $this->id_user = htmlspecialchars(strip_tags($this->id_user));
          $this->phoneNumber = htmlspecialchars(strip_tags($this->phoneNumber));


          // Bind data
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':type', $this->type);
          $stmt->bindParam(':description', $this->description);
          $stmt->bindParam(':location', $this->location);
          $stmt->bindParam(':date', $this->date);
          $stmt->bindParam(':imagePath', $this->imagePath);
          $stmt->bindParam(':id_user', $this->id_user);
                    $stmt->bindParam(':phoneNumber', $this->phoneNumber);

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
          $query = 'DELETE FROM posts WHERE id = :id';

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
    
  }
