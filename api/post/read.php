<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/db.php';
  include_once '../../models/post.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Blog post query
  $result = $post->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $posts_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
       
        'title' => $title,
        'description' => $description,
        'type' => $type,
        'location' => $location,
        'date' => $date,
        'imagePath' => $imagePath,
        'id_user'=> $id_user,
        'phoneNumber'=> $phoneNumber,
        'idPost'=> $id


      );

      // Push to "data"
      array_push($posts_arr, $post_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($posts_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }