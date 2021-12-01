<?php 
  // Headers
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
        header('Access-Control-Max-Age: 1728000');
        header('Content-Length: 0');
        header('Content-Type: application/json');
        die();
    }

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    
  include_once '../../config/db.php';
  include_once '../../models/user.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog user object
  $user = new User ($db);

  // Get raw user data
  $data = json_decode(file_get_contents("php://input"));

  $user->username = $data->username;
  $user->email = $data->email;
  $user->password = $data->password;
  


  // Create post
  if($user->create()) {
    echo json_encode(
      array('message' => 'User Created')
    );
  } else {
    echo json_encode(
      array('message' => 'User Not Created')
    );
  }