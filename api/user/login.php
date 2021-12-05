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

  // Instantiate user object
  $user = new User($db);
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
    'type' => $user->type,
    'id_post' => $user->id_post,
    'title' => $user->title,
    'location' => $user->location,
    'imagePath' => $user->imagePath,
    'date' => $user->date,
    'description' => $user->description,
    );

  // Make JSON
  print_r(json_encode($user_arr));