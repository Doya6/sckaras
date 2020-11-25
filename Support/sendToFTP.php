<?php
// connect and login to FTP server
$ftp_server = "medvidek.endora.cz";
$ftp_username = "mytestwwwtodecz";
$ftp_userpass = "HondaX11";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);



$fd = fopen('C:\Ce\SCKaras\Support\02_help.txt', 'r');

// upload file
if (ftp_put($ftp_conn, "02_help.txt", $fd, FTP_ASCII))
  {
  echo "Successfully uploaded $file.";
  }
else
  {
  echo "Error uploading $file.";
  }

// close connection
ftp_close($ftp_conn);
?>

<?php
//$ftp = ftp_connect($host,$port,$timeout);
//ftp_login($ftp,$user,$pass);

//$ret = ftp_nb_put($ftp, $dest_file, $source_file, FTP_BINARY, FTP_AUTORESUME);

//while (FTP_MOREDATA == $ret)
//    {
//        // display progress bar, or someting
//        $ret = ftp_nb_continue($ftp);
//    }
//ftp_close($ftp)
?>