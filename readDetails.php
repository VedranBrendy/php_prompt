<?php
// include Database connection file
include_once("db.php");

// check request
if(isset($_GET['id']) && isset($_GET['id']) != ""){
    
    // get User ID
    $id = $_GET['id'];


    // Get User Details
    $query = "SELECT * FROM post WHERE id = :id";


    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id); 
    $stmt->execute(); 
        
    if (!$stmt) {
        die('Error');
    }

    $response = array();

    if($stmt->rowCount() > 0) {

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $response = $row;

        }

    } else {

        $response['status'] = 200;
        $response['message'] = "Data not found!";

    }
    // display JSON data
    echo json_encode($response);
} else {
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}