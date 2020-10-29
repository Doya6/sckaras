<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);
//$lookAtTable = $received_data['lookAtTable'];
//$lookAtColumn = $received_data['lookAtColumn'];
//$lookForValue = $received_data['lookForValue'];

$lookAtTable = "Users";
$lookAtColumn = "userEmail";
$lookForValue = "User1@email.cz";

$row = "";
$exists = "";

$query = "SELECT * FROM $lookAtTable WHERE $lookAtColumn = '$lookForValue' ";  
$statement = $connect->prepare($query);
$statement->execute();
 
$row = $statement->fetch(PDO::FETCH_ASSOC);

  if ($row > 0) {
    $exists = true;
  } else {
    $exists = false;
  }

  echo (json_encode($exists));

?>