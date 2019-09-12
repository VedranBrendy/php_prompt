<?php
// check request
// include Database connection file
if(isset($_GET['id']) && isset($_GET['id']) != ""){
include_once("db.php");

    // get user id
    $id = $_GET['id'];

     // delete User
    $query = "DELETE FROM `post` WHERE `id` = :id";

	 	$stmt = $pdo->prepare($query);
	  $stmt->bindParam(":id", $id); 
	  $result = $stmt->execute(['id' => $id]); 
        
      if (!$result) {

        echo '0';

      } else {

        echo '1';
      } 
}
?>