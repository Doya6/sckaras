<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);

$userID = $received_data['sqlStringUserID'];

//$userID = 114;

$data = [];

if($userID == ''){
	
	$msg = "Nejste prihlaseni";
	echo json_encode($msg);

} else {

$query =  "SELECT * , Events.event_id AS myEventID, SUM(sumOfAttendees) AS mySUM FROM Events LEFT JOIN Rezrvs ON Events.event_id=Rezrvs.event_id WHERE Events.event_id IN (SELECT event_id FROM Rezrvs WHERE user_id = $userID)";


	$statement = $connect->prepare($query);
	$statement->execute();
 
 	while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    		$data[] = $row;
  		}

  echo json_encode($data);  
}

?>