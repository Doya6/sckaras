<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'config.php';

$data = [];

$query = "SELECT * FROM Events WHERE eventStartDate = date() ";  
$statement = $connect->prepare($query);
$statement->execute();
 
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $data[] = $row;
  }
  echo json_encode($data);

?>