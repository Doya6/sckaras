<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'config.php';

$phpInput = json_decode(file_get_contents("php://input"), true);

//$insertIntoTable = $phpInput['insertIntoTable'];
//$insertIntoColumns = $phpInput['insertIntoColumns'];
//$insertValues = $phpInput['insertValues']; 

//-------------
 $insertIntoTable = "Events";
 $insertIntoColumns = "eventType_id, eventName, eventDesc, eventStartDate, eventEndDate, minSumOfAttendees, maxSumOfAttendees, initializator_id";
 $insertValues = `4, 'dfgh', 'dfgh', '2020-11-22 11:00', '2020-11-22 13:00', 1, 10, 1`;
//-------------

$query = "INSERT INTO $insertIntoTable ($insertIntoColumns) VALUES ($insertValues) ";  

echo $query;

$statement = $connect->prepare($query);
$statement->execute();

$arr = $statement->errorInfo();
if (json_encode($arr[2]) == 'null'){
	if ($insertIntoTable === "Users"){
	$result = "Byli jste úspěšně zaregistrováni.";
	} elseif ($insertIntoTable === "Rezrvs") { 
	$result = "Rezervace byla úspěšně vytvořena.";
	} else 
	$result = "Data byla odeslána na server.";
	
} else {
	$result = ($arr[2]);
}
echo $result;

?>