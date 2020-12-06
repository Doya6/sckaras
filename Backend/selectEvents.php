<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);
$aktivityTypes = $received_data['sqlStringWhere'];
$aktivityTypesArray = ("'" . implode("', ' ",$received_data['sqlStringWhere']) . "'");

if($aktivityTypes === []){
  //$query = "SELECT Events.event_id, Events.eventType_id, Events.eventName, Events.eventDesc, EventsCalendar.eventStartDate, EventsCalendar.eventEndDate, Events.maxSumOfAttendees, Events.eventCancelDate, Events.initializator_id, Users.userName, Users.userEmail, Users.userPhoneNum, Events.event_id AS myEventID, SUM(sumOfAttendees) AS mySUM FROM Events JOIN Users ON Users.userID=Events.initializator_id LEFT JOIN Rezrvs ON Events.event_id=Rezrvs.event_id WHERE DateDiff(Now(), Events.eventStartDate) <= 0 GROUP BY Events.event_id ORDER BY Events.eventStartDate ASC";
  $query = "SELECT EventsCalendar.eventCalendar_id, EventsCalendar.event_id, Events.eventType_id, Events.eventName, Events.eventDesc, EventsCalendar.eventStartDate, EventsCalendar.eventEndDate, Events.maxSumOfAttendees, EventsCalendar.eventCancelDate, Events.initializator_id, Users.userName, Users.userEmail, Users.userPhoneNum, EventsCalendar.eventCalendar_id AS myEventID, SUM(sumOfAttendees) AS mySUM FROM EventsCalendar JOIN Events ON Events.event_id=EventsCalendar.event_id JOIN Users ON Users.userID=Events.initializator_id LEFT JOIN Rezrvs ON EventsCalendar.eventCalendar_id=Rezrvs.eventCalendar_id WHERE DateDiff(Now(), EventsCalendar.eventStartDate) <= 0 GROUP BY EventsCalendar.eventCalendar_id ORDER BY EventsCalendar.eventStartDate ASC";

}
else {
  //$query = "SELECT *, Events.event_id AS myEventID, SUM(sumOfAttendees) AS mySUM FROM Events LEFT JOIN Rezrvs ON Events.event_id=Rezrvs.event_id WHERE eventType_id IN ($aktivityTypesArray) AND DateDiff(Now(), Events.eventStartDate) <= 0 GROUP BY Events.event_id ORDER BY Events.eventStartDate ASC"; 
  //$query = "SELECT *, EventsCalendar.eventCalendar_id AS myEventID, SUM(sumOfAttendees) AS mySUM FROM EventsCalendar LEFT JOIN Rezrvs ON EventsCalendar.eventCalenddar_id=Rezrvs.eventCalendar_id WHERE eventType_id IN ($aktivityTypesArray) AND DateDiff(Now(), EventsCalendar.eventStartDate) <= 0 GROUP BY EventsCalendar.eventCalendar_id ORDER BY EventsCalendar.eventStartDate ASC"; 
  $query = "SELECT EventsCalendar.eventCalendar_id, EventsCalendar.event_id, Events.eventType_id, Events.eventName, Events.eventDesc, EventsCalendar.eventStartDate, EventsCalendar.eventEndDate, Events.maxSumOfAttendees, EventsCalendar.eventCancelDate, Events.initializator_id, Users.userName, Users.userEmail, Users.userPhoneNum, EventsCalendar.eventCalendar_id AS myEventID, SUM(sumOfAttendees) AS mySUM FROM EventsCalendar LEFT JOIN Events ON Events.event_id=EventsCalendar.event_id JOIN Users ON Users.userID=Events.initializator_id LEFT JOIN Rezrvs ON EventsCalendar.eventCalendar_id=Rezrvs.eventCalendar_id WHERE DateDiff(Now(), EventsCalendar.eventStartDate) <= 0 AND Events.eventType_id IN ($aktivityTypesArray) GROUP BY EventsCalendar.eventCalendar_id ORDER BY EventsCalendar.eventStartDate ASC";

}  

$statement = $connect->prepare($query);
$statement->execute();
 
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $data[] = $row;
  }

  echo json_encode($data);  

?>