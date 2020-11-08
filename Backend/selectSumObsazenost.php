<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);

$eventId = $received_data['selsectEventId'];

  $query = "SELECT SUM(sumOfAttendees) AS mySum FROM Rezrvs WHERE event_id = '$eventId' "; 
 
$statement = $connect->prepare($query);
$statement->execute();

  
  while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $data = $row["mySum"];
  }
  
  echo json_encode($data);

?>