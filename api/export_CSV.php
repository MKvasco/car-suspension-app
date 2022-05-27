<?php
// header('Content-Type: application/json; charset=utf-8');
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once "config.php";


$sql = "SELECT * FROM SYSTEM_LOGS";
$statement = $conn->prepare($sql);
$statement->execute();
$rows = $statement->fetchAll();
$columnNames = array();
if(!empty($rows)){
    $firstRow = $rows[0];
    foreach($firstRow as $colName => $val){
        $columnNames[] = $colName;
    }
}

$fileName = 'export.csv';
header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
$fp = fopen('export.csv', 'a+');
fputcsv($fp, $columnNames);
foreach ($rows as $row) {
    fputcsv($fp, $row);
}
fclose($fp);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$mail = new PHPMailer (true);
try {

    $mail->isSMTP();
    $mail->Host = 'mail.stuba.sk';
    $mail->SMTPAuth = true;

    //////////////////////////////////
    $mail->Username = '***REMOVED***';
    $mail->Password = '***REMOVED***';
    ///////////////////////////////////
    $mail->SMTPSecure = 'tls';
    $mail->Port = 25;

    $mail->setFrom('***REMOVED***','webte2');
    $mail->addAddress($email,'Dream team');


    $file_to_attach = 'export.csv';

    $mail->AddAttachment( $file_to_attach , 'export.csv' );

//Content
    $mail->isHTML (true);
// Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


    $mail->send();
    echo json_encode('Message has been sent');
} catch (Exception $e) {
    echo json_encode("Message could not be sent. Mailer Error: $mail->ErrorInfo");
}