<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $auhtorob = new Author($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $auhtorob->id = $data->id;

  $auhtorob->author = $data->author;

  // Update post
  if($auhtorob->update()) {
    echo json_encode(
      array('message' => 'author Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'author not updated')
    );
  }
