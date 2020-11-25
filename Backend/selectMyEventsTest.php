<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);

//$userID = $received_data['sqlStringUserID'];

$userID = "1";

$data = [];

$query =  "SELECT * , Events.event_id AS myEventID, SUM(sumOfAttendees) AS mySUM FROM Events LEFT JOIN Rezrvs ON Events.event_id=Rezrvs.event_id WHERE Events.event_id IN (SELECT Rezrvs.event_id FROM Rezrvs WHERE Rezrvs.user_id = 1) GROUP BY Events.event_id";


//$query =  "SELECT * , Events.event_id AS myEventID, SUM(sumOfAttendees) AS mySUM FROM Events LEFT JOIN Rezrvs ON Events.event_id=Rezrvs.event_id WHERE Events.event_id IN (SELECT Rezrvs.event_id FROM Rezrvs WHERE Rezrvs.user_id = 1 AND Rzrvs.sumOfAttendees > 0) GROUP BY Events.event_id";

//$query =  "SELECT event_id FROM Rezrvs WHERE user_id = $userID AND rezrvCanceled = 0";

	$statement = $connect->prepare($query);
	$statement->execute();
 
 	while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    		$data[] = $row;
  		}

 

   if ($data <> ''){
	echo json_encode($data);
	} else {
	  echo "empty";
	  
	}
  

?>