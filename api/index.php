<?php
session_start();
if (!isset($_SESSION["lang"])) { $_SESSION["lang"] = "en"; }
if (isset($_POST["lang"])) { $_SESSION["lang"] = $_POST["lang"]; }


require "lang-" . $_SESSION["lang"] . ".php";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// (A) CONNECT TO DATABASE - CHANGE SETTINGS TO YOUR OWN!
$dbHost = "localhost";
$dbName = "final";
$dbChar = "utf8";
$dbUser = "xfrandofer";
$dbPass = "password";
try {
    $pdo = new PDO(
        "mysql:host=$dbHost;dbname=$dbName;charset=$dbChar",
        $dbUser, $dbPass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
        ]
    );
} catch (Exception $ex) { exit($ex->getMessage()); }
// (B) CREATE EMPTY CSV FILE ON SERVER
$csvFile = "export.csv";
$handle = fopen($csvFile, "w");
if ($handle === false) { exit("Error creating $csvFile"); }

// (C) GET USERS FROM DATABASE + WRITE TO FILE
$stmt = $pdo->prepare("SELECT * FROM `finals`");  /////////////////////////////////
$stmt->execute();
while ($row = $stmt->fetch()) {
    // print_r($row);
    fputcsv($handle, [$row["user_id"], $row["user_email"], $row["user_name"]]);
}
fclose($handle);
echo "DONE!";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* @var $email*/
require_once 'config.php';



?>
<!doctype html>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" href="../client/Styles/myStyle.css">
    <link rel="stylesheet" media="print" href="../client/Styles/style_print.css">

    <!--  <title>final</title>-->

    <title><?=$_TXT[0]?></title>
</head>
<body lang="<?=$_SESSION["lang"]?>">

<form method="post">
    <input type="submit" name="lang" value="en" id="en_flag"/>
    <input type="submit" name="lang" value="sk" id="sk_flag"/>
</form>

<form method="post" action="mailto:<?php echo $email;?>">
    <input type="file" src="export.csv">
    <input type="submit" value="submit">
</form>


<div id="game">
    <p><?=$_TXT[1]?></p>
</div>
<p id="hra" style="display: none" ><?=$_TXT[2]?></p>

<button onclick="window.print()"><?=$_TXT[3]?> </button>

<script>
    function changeLanguage(lang) {
        location.hash = lang;
        location.reload();
    }
</script>

</body>
</html>