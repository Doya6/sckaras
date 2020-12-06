<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include "FTP_conf.php";

$target_dir = "/HomePagePic/AktivityPics/"; 
$destination_file = $target_dir . basename($_FILES["file"]["name"]);
$source_file = $_FILES['file']['tmp_name'];
 
$imageFileType = strtolower(pathinfo($destination_file,PATHINFO_EXTENSION));
 
if(isset($_POST["submit"])) { 
    $check = getimagesize($_FILES["file"]["tmp_name"]); 
    if($check !== false) { 
        echo "File is an image - " . $check["mime"] . "." . "<br/>"; 

	$conn_id = ftp_connect($ftp_server);
	ftp_pasv($conn_id, true); 

	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 

	if ((!$conn_id) || (!$login_result)) { 
	    echo "FTP connection has failed!" . "<br/>";
	    echo "Attempted to connect to $ftp_server for user $ftp_user_name" . "<br/>"; 
	    exit; 
	} else {
		echo "Connected to $ftp_server, for user $ftp_user_name" . "<br/>";
		$message = "Connected to $ftp_server, for user $ftp_user_name";
	}

	//$upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);
	$upload_path = '/' . time();
	move_uploaded_file($_FILES['file']['tmp_name'], $upload_path);

	if (!$upload) { 
	echo "FTP upload has failed!" . "<br/>";
	} else {
	echo "Uploaded $source_file to $ftp_server as $destination_file" . "<br/>";
	}

	ftp_close($conn_id);

} else { 
        echo "File is not an image." . "<br/>";  
    } 
} 

echo "source_file: " . $source_file . "<br/>" . "destination_file: " . $destination_file . "<br/>";

?>