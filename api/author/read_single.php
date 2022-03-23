<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $authorob = new Author($db);

  // Get ID
  $authorob->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $authorob->read_single();

  // Create array
  $category_arr = array(
    'id' => $authorob->id,
    'author' => $authorob->author
  );

  // Make JSON
  print_r(json_encode($category_arr));
