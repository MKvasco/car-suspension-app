<?php
//header('Content-Type: application/json; charset=utf-8');
//
//
//// (B) CREATE EMPTY CSV FILE ON SERVER
//$csvFile = "export.csv";
//$handle = fopen($csvFile, "w");
//if ($handle === false) {
//    exit("Error creating $csvFile");
//}
//
//echo 'tu som';
//
//// (C) GET USERS FROM DATABASE + WRITE TO FILE
//$test=[["id"=>"1","command"=>"1+1"],["id"=>"2","command"=>"2+2"]];
//while ($row = $test) {
//    // print_r($row);
//    fputcsv($handle, [$row["id"], $row["command"]]);
//}
//fclose($handle);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once('libphp-phpmailer/autoload.php');

$mail = new PHPMailer (true);
try {

    $mail->isSMTP();
    $mail->Host = 'mail.stuba.sk';
    $mail->SMTPAuth = true;
    $mail->Username = 'xfrandofer';
    $mail->Password = 'weC.owy.5.isi';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 25;

    $mail->setFrom('xfrandofer@stuba.sk','webte2');
    $mail->addAddress('xfrandofer@stuba.sk','erik');


//$mail->addAttachment ('mickey.jpg', 'mys.jpg'); // Optional name
    $file_to_attach = 'export.csv';

    $mail->AddAttachment( $file_to_attach , 'export.csv' );

//Content
    $mail->isHTML (true);
// Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>