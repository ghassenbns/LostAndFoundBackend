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
       $posts_arr = array();
 while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      if($row['idPost']> 0){
  // Create array
  $post_item = array(
    'type' => $type,
    'idPost' => $idPost,
    'title' => $title,
    'location' => $location,
    'imagePath' => $imagePath,
    'date' => $date,
    'description' => $description 
  );
    array_push($posts_arr, $post_item);

    }  
  }
    $user_obj = array(
    'username' => $username,
    'email' => $email,
    'password' =>$password,
    'id' => $id,
    'phoneNumber'=> $phoneNumber,
    'posts'=>$posts_arr
  );
    
              // Turn to JSON & output
    echo json_encode($user_obj);
  }
  else{
      http_response_code(404);
}
  