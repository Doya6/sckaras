<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);

$eventID = $received_data['eventID'];
$userID = $received_data['userID'];


$query = "UPDATE Rezrvs SET rezrvCanceled = 'yes' WHERE event_id = $eventID AND user_id = $userID";

$statement = $connect->prepare($query);
$statement->execute();
 
?>