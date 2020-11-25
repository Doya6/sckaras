<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);

// $datum = $received_data['cancelDate'];
// $eventID = $received_data['eventID'];
// $userID = $received_data['userID'];

$eventID = 2;
$userID = 1;


$query = "DELETE FROM Rezrvs WHERE event_id = $eventID AND user_id = $userID";

$statement = $connect->prepare($query);
$statement->execute();
 
?>