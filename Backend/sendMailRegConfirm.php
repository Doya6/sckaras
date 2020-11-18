<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

$received_data = json_decode(file_get_contents("php://input"), true);
$userName = $received_data['name'];
$userEmail = $received_data['email'];
$userPswd = $received_data['pswd'];

$to_email = $userEmail;
$subject = 'SC Karas - potvrzeni registrace';

$message = "Na stránkách SCKaras.cz jste se zaregistrovali jako užvatel: $userName \n\n Heslo: $userPswd \n \n Pro přihlášení použijte vaši e-mail adresu $userEmail.";

$headers = "From: noreply@sckaras.cz \n".
            "Reply-To: noreply@sckaras.cz" . "\r\n" .
         "MIME-Version: 1.0\n".
         "Content-Type: text/plain; charset=\"UTF-8\"\n".
          "Content-Transfer-Encoding: 8bit";
 

//check if the email address is invalid $secure_check

$secure_check = sanitize_my_email($to_email);
if ($secure_check == false) {
    echo "Invalid input";
} else { //send email 
    mail($to_email, $subject, $message, $headers);
    echo "This email is sent using PHP Mail";
}

?>