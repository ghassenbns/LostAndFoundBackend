<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/db.php';
  include_once '../../models/user.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $user = new Post($db);

  // Get ID
  $user->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $user->login();

  // Create array
  $user_arr = array(
    'id' => $user->id,
    'email' => $user->email,
    'password' => $user->password,
    'username' => $user->username,
   
  );

  // Make JSON
  print_r(json_encode($post_arr));