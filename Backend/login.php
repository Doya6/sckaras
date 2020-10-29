<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'config.php';


$received_data = json_decode(file_get_contents("php://input"), true);
$userEmail = $received_data['loginEmail'];
// $userPassword = $received_data['loginPassword'];
// echo ("ParametryJsou: " . $userEmail);

$data = array();


  $query = "SELECT user_id, userName, userPswd FROM Users WHERE userEmail = '$userEmail' ";
  $statement = $connect->prepare($query);
  $statement->execute();
  while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $data[] = $row;
  }
  echo (json_encode($data));


?>