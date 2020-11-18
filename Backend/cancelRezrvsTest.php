<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);

// $datum = $received_data['cancelDate'];
// $eventID = $received_data['eventID'];
// $userID = $received_data['userID'];

$datum = "2020-5-5";
$eventID = 3;
$userID = 3;


$query = "UPDATE Rezrvs SET rezrvCancelDate = $datum WHERE event_id = $eventID AND user_id = $userID";

$statement = $connect->prepare($query);
$statement->execute();
 
?>