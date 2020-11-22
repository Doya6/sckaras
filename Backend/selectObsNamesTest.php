<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
include 'config.php';

$received_data = json_decode(file_get_contents("php://input"), true);

$userID = $received_data['sqlStringUserID'];

$data = [];

$query =  "SELECT userName FROM Users LEFT JOIN Rezrvs ON Rezrvs.user_id=Users.userID WHERE event_id = '1'";



	$statement = $connect->prepare($query);
	$statement->execute();
 
 	while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    	$data[] = $row;
  	}

  echo json_encode($data);

?>