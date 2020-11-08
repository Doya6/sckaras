<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);

$aktivityTypes = $received_data['sqlStringWhere'];

$aktivityTypesArray = ("'" . implode("', ' ",$received_data['sqlStringWhere']) . "'");


$data = [];

if($aktivityTypes === []){
  $query = "SELECT * FROM Events";
}
else {
  $query = "SELECT * FROM Events WHERE eventType_id IN ($aktivityTypesArray) "; 
}  

$statement = $connect->prepare($query);
$statement->execute();
 
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $data[] = $row;
  }

  echo json_encode($data);  

?>