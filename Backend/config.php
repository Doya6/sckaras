<?php

$username="testrezervace";
$password="rezervacePSW1";
$host="localhost";
$database="karas2";

$connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
// if (!$connect) {
// echo (" NEnapojeno na sql");
//   die("Connection failed: " . mysqli_connect_error());
// } else echo (" --- napojeno na sql databazi '" . $database . "' --- ");

?>