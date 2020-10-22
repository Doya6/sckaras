<?php

include 'config.php';

$connect = new PDO("mysql:host=$host;dbname=$database", $username, $password);

if (!$connect) {
echo (" NEnapojeno na sql");
  die("Connection failed: " . mysqli_connect_error());
  
}
if ($connect) {
  echo (" ---napojeno na sql--- ");
}

/*
$received_data = json_decode(file_get_contents("php://input"), true);
$task = 'fetchall';

$data = array();

if($task == 'fetchall'){
  $query = "SELECT * FROM users";
  $statement = $connect->prepare($query);
  $statement->execute();
  while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $data[] = $row;
  }
  echo ("Data: " . json_encode($data));
}
*/

?>