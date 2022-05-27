<?php
/* @var $conn*/
require_once "config.php";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=export.csv');
$output = fopen("php://output", "w");
fputcsv($output, array('id', 'command'));
$query = "SELECT * FROM system_logs ORDER BY id DESC";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)){
    fputcsv($output, $row);
}
fclose($output);



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once('libphp-phpmailer/autoload.php');

$mail = new PHPMailer (true);
try {

    $mail->isSMTP();
    $mail->Host = 'mail.stuba.sk';
    $mail->SMTPAuth = true;

    //////////////////////////////////
    $mail->Username = 'AIS LOGIN';
    $mail->Password = 'AIS PASSWORD';
    ///////////////////////////////////
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