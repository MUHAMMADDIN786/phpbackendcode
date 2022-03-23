<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $categoryob = new Category($db);

  // Get ID
  $categoryob->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $categoryob->read_single();

  // Create array
  $category_arr = array(
    'id' => $categoryob->id,
    'category' => $categoryob->category
  );

  // Make JSON
  print_r(json_encode($category_arr));
