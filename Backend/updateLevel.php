<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);

$email = $received_data['email'];
$level = $received_data['level'];


$query = "UPDATE Users SET userLevel = $level WHERE userEmail = '$email'";

$statement = $connect->prepare($query);
$statement->execute();
 
?>