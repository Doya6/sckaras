<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);

$query = "SELECT * FROM EventTypes";  
$statement = $connect->prepare($query);
$statement->execute();
 
//$row = $statement->fetch(PDO::FETCH_ASSOC);

  while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $data[] = $row;
  }
  echo json_encode($data);


?>