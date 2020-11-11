<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'config.php';

$phpInput = json_decode(file_get_contents("php://input"), true);

$insertIntoTable = $phpInput['insertIntoTable'];
$insertIntoColumns = $phpInput['insertIntoColumns'];
$insertValues = $phpInput['insertValues'];

//-------------
// $insertIntoTable = "Users";
// $insertIntoColumns = "userName, userPswd, userEmail";
// $insertValues = "'User4', 'User4PSWD', 'User5@email.cz'";
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