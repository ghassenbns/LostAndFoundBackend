<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/db.php';
  include_once '../../models/user.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate user object
  $user = new Post($db);
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Get ID
  $user->email = $data->email;
    $user->password = $data->password;


  // Get user
  $user->login();

  // Create array
  $user_arr = array(
    'username' => $user->username,
    'email' => $user->email,
    'password' => $user->password,
        'id' => $user->id,

    
  );

  // Make JSON
  print_r(json_encode($user_arr));