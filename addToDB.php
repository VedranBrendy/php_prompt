<?php 
  include_once('db.php');
  
  //Get data from texarea
  if (isset($_GET['result']) && $_GET['result'] != 'null') {
  $text = $_GET['result'];
  $sql = 'INSERT INTO post(text) VALUES(:text)';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['text' => $text]);
  //echo for testing
    echo 1;

  } else {

    echo  0; 
}


?>