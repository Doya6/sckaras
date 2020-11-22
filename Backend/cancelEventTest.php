<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);

$eventID = $received_data['event'];
$datum = $received_data['date'];
$eventID = 17;
$datum = '2020-11-22 22:00';



$query = "UPDATE Events SET eventCancelDate = '$datum' WHERE event_id = '$eventID'";

$statement = $connect->prepare($query);
$statement->execute();

echo $query;
 
?>