<?php
// include Database connection file
include("db.php");

// check request
// if(isset($_GET['id']) && isset($_GET['result'])) {
if(isset($_GET['id']) && isset($_GET['result'])) {
    // get values
    $id = $_GET['id'];
    $res = $_GET['result'];

    // Updaste User details
    $query = "UPDATE post SET text = :res WHERE id = :id";
   
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id); 
        $stmt->bindParam(":res", $res); 
        $stmt->execute(); 
        
      if (!$stmt) {

        echo '0';

      } else {

        echo '1';
      }  
}

?>