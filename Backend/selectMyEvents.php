<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);

$userID = $received_data['sqlStringUserID'];

$data = [];

//$query =  "SELECT * , Events.event_id AS myEventID, SUM(sumOfAttendees) AS mySUM FROM Events LEFT JOIN Rezrvs ON Events.event_id=Rezrvs.event_id WHERE Events.event_id IN (SELECT event_id FROM Rezrvs WHERE user_id = $userID) AND DateDiff(Now(), Events.eventStartDate) <= 0 GROUP BY Events.event_id";
$query =  "SELECT EventsCalendar.eventCalendar_id, EventsCalendar.event_id, Events.eventType_id, Events.eventName, Events.eventDesc, EventsCalendar.eventStartDate, EventsCalendar.eventEndDate, Events.maxSumOfAttendees, EventsCalendar.eventCancelDate, Events.initializator_id, Users.userName, Users.userEmail, Users.userPhoneNum, EventsCalendar.eventCalendar_id AS myEventID, SUM(sumOfAttendees) AS mySUM FROM EventsCalendar JOIN Events ON Events.event_id=EventsCalendar.event_id JOIN Users ON Users.userID=Events.initializator_id LEFT JOIN Rezrvs ON EventsCalendar.eventCalendar_id=Rezrvs.eventCalendar_id WHERE DateDiff(Now(), EventsCalendar.eventStartDate) <= 0 AND EventsCalendar.eventCalendar_id IN (SELECT eventCalendar_id FROM Rezrvs WHERE user_id = $userID) GROUP BY EventsCalendar.eventCalendar_id ORDER BY EventsCalendar.eventStartDate ASC";

	$statement = $connect->prepare($query);
	$statement->execute();
 
 	while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    	$data[] = $row;
  	}

  echo json_encode($data);

?>