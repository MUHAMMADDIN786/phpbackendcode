<?php 
  class Quote {
    // DB stuff
    private $conn;
    private $table = 'quotes';

    // Post Properties
    public $id;
    public $quote;
    public $authorId;
    public $categoryId;
 
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      
      $query = 'SELECT quotes.id, quote, author, category
                  FROM ' . $this->table . ' JOIN authors a on quotes.authorId = a.id join categories c on c.id = quotes.categoryId';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
   // Get Single Post
   public function read_single() {
    // Create query
    $query = 'SELECT quotes.id, quote, author, category 
                              FROM ' . $this->table . '
                              JOIN authors a on quotes.authorId = a.id join categories c on c.id = quotes.categoryId
                              WHERE quotes.id=?
                              LIMIT 0,1';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->id);

    // Execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set properties
    $this->quote = $row['quote'];
    $this->author = $row['author'];
    $this->category = $row['category'];
}

 // all quotes of respective Author
public function read_qoutesOfAuthor() {
  // Create query
  $query = 'SELECT quotes.id, quote, author, category 
                            FROM ' . $this->table . '
                            JOIN authors a on quotes.authorId = a.id join categories c on c.id = quotes.categoryId
                            WHERE a.id=?'
                            ;

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Bind ID
  $stmt->bindParam(1, $this->id);

  // Execute query
  $stmt->execute();
  return $stmt;

  // $row = $stmt->fetch(PDO::FETCH_ASSOC);

  // // Set properties
  // $this->quote = $row['quote'];
  // $this->author = $row['author'];
  // $this->category = $row['category'];
}

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET quote = :quote, authorId = :authorId, categoryId = :categoryId';
          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->quote = htmlspecialchars(strip_tags($this->quote));
          $this->authorId = htmlspecialchars(strip_tags($this->authorId));
          $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

          // Bind data
          $stmt->bindParam(':quote', $this->quote);
          $stmt->bindParam(':authorId', $this->authorId);
          $stmt->bindParam(':categoryId', $this->categoryId);

          // Execute query
          if($stmt->execute()) {
            return true;
         }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET quote = :quote, authorId = :authorId, categoryId = :categoryId
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->quote = htmlspecialchars(strip_tags($this->quote));
          $this->authorId = htmlspecialchars(strip_tags($this->authorId));
          $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

          // Bind data
          $stmt->bindParam(':quote', $this->quote);
          $stmt->bindParam(':authorId', $this->authorId);
          $stmt->bindParam(':categoryId', $this->categoryId);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }