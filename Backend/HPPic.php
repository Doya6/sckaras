<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'config.php';

$sourceDir = 'HomePagePic';
$files = glob($sourceDir .'/*.jpg');

usort($files, function($a, $b) {
	return filemtime($b) > filemtime($a);
});

//$theLatestFile = filemtime($files[0]);
$theFileName = basename($files[0]);

//echo date("d.m.Y H:i:s", $theLatestFile);
//echo "<br>";

echo  $theFileName;

?>