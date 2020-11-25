<?php

var ftpClient = new FtpClient("medvidek.endora.cz", "21", "mytestwwwtodecz", "HondaX11");

ftpClient.connect().then(function () {
   ftpClient.upload("C:\Ce\SCKaras\Support\02_help.txt", buffer)
});

?>