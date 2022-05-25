<?php
// require "lang-" . $_SESSION["lang"] . ".php";
require_once 'config.php';


// session_start();

// if (!isset($_SESSION["lang"])) $_SESSION["lang"] = "en";
// if (isset($_POST["lang"])) $_SESSION["lang"] = $_POST["lang"];

// // (B) CREATE EMPTY CSV FILE ON SERVER
// $csvFile = "../data/exports/export.csv";
// $handle = fopen($csvFile, "w");
// if ($handle === false) { exit("Error creating $csvFile"); }

// // (C) GET USERS FROM DATABASE + WRITE TO FILE
// $stmt = $pdo->prepare("SELECT * FROM `users`");
// $stmt->execute();
// while ($row = $stmt->fetch()) {
//     // print_r($row);
//     fputcsv($handle, [$row["user_id"], $row["user_email"], $row["user_name"]]);
// }

// fclose($handle);
// echo "DONE!";