<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);
//$lookForUser = $received_data['lookForUser'];
 $lookForUser = "114";

$data = [];


$query = "SELECT * FROM Rezrvs WHERE user_id = '$lookForUser' ";  
$statement = $connect->prepare($query);
$statement->execute();



while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $data[] = $row;
  }

if (count($data) <> 0){
  echo json_encode($data);
  } else {echo count($data);}

?>

