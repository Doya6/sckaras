<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);

$aktivityTypes = $received_data['sqlStringWhere'];

$aktivityTypesArray = ("'" . implode("', ' ",$received_data['sqlStringWhere']) . "'");


$data = [];

if($aktivityTypes === []){

//$query = "SELECT * , Events.event_id AS myEventID, SUM(sumOfAttendees) AS mySUM FROM `Events` JOIN Users ON Users.userID=Events.initializator_id LEFT JOIN Rezrvs ON Events.event_id=Rezrvs.event_id GROUP BY Events.event_id ORDER BY Events.eventStartDate ASC";

  $query = "SELECT Events.event_id, Events.eventType_id, Events.eventName, Events.eventDesc, Events.eventStartDate, Events.eventEndDate, Events.maxSumOfAttendees, Events.eventCancelDate, Events.initializator_id, Users.userName, Users.userEmail, Users.userPhoneNum, Events.event_id AS myEventID, SUM(sumOfAttendees) AS mySUM FROM `Events` JOIN Users ON Users.userID=Events.initializator_id LEFT JOIN Rezrvs ON Events.event_id=Rezrvs.event_id GROUP BY Events.event_id ORDER BY Events.eventStartDate ASC";

}
else {
  $query = "SELECT * , Events.event_id AS myEventID, SUM(sumOfAttendees) AS mySUM FROM Events LEFT JOIN Rezrvs ON Events.event_id=Rezrvs.event_id WHERE eventType_id IN ($aktivityTypesArray) GROUP BY Events.event_id ORDER BY Events.eventStartDate ASC"; 
}  

$statement = $connect->prepare($query);
$statement->execute();
 
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $data[] = $row;
  }

  echo json_encode($data);  

?>