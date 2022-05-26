<?php
/* @var $email*/
/* @var $conn*/
require_once "config.php";

header('Content-Type: application/json; charset=utf-8');


// (B) CREATE EMPTY CSV FILE ON SERVER
$csvFile = "export.csv";
$handle = fopen($csvFile, "w");
if ($handle === false) { exit("Error creating $csvFile"); }

// (C) GET USERS FROM DATABASE + WRITE TO FILE
$stmt = $conn->prepare("SELECT * FROM `system_logs`");
$stmt->execute();
while ($row = $stmt->fetch()) {
    // print_r($row);
    fputcsv($handle, [$row["id"], $row["command"]]);
}
fclose($handle);
echo "DONE!";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$to = $email;
$subject = 'Final Project CSV';
$from_name='Dream Team';
$from_mail='xkovacik1@stuba.sk';
$replyto='xkovacik1@stuba.sk';

$fileatt_type = "text/csv";
$myfile = $csvFile;
$file_size = filesize($myfile);
$handle = fopen($myfile, "r");
$content = fread($handle, $file_size);
$content = chunk_split(base64_encode($content));

$message = "<html>
<head>
  <title>Final Project Logs</title>
</head>
<body><table><tr><td>Logs CSV</td></tr></table></body></html>";

$uid = md5(uniqid(time()));

$header = "From: ".$from_name." <".$from_mail.">\r\n";
$header .= "Reply-To: ".$replyto."\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
$header .= "This is a multi-part message in MIME format.\r\n";
$header .= "--".$uid."\r\n";
$header .= "Content-type:text/html; charset=iso-8859-1\r\n";
$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$header .= $message."\r\n\r\n";
$header .= "--".$uid."\r\n";
$header .= "Content-Type: text/csv; name=\"".$myfile."\"\r\n"; // use diff. tyoes here
$header .= "Content-Transfer-Encoding: base64\r\n";
$header .= "Content-Disposition: attachment; filename=\"".$myfile."\"\r\n\r\n";
$header .= $content."\r\n\r\n";
$header .= "--".$uid."--";

mail($to, $subject, $message, $header);
?>