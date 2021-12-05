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
  $result = $user->login();
  $num = $result->rowCount();
 if($num > 0) {
       $user_arr = array();
 while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
  // Create array
  $user_item = array(
    'username' => $username,
    'email' => $email,
    'password' =>$password,
    'id' => $id,
    'type' => $type,
    'id_post' => $id_post,
    'title' => $title,
    'location' => $location,
    'imagePath' => $imagePath,
    'date' => $date,
    'description' => $description,
    );
    array_push($user_arr, $user_item);
    }  
        
    
              // Turn to JSON & output
    echo json_encode($user_arr);
  }
  else{
      http_response_code(404);
          }
  