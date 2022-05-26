<?php 
require_once "config.php";

try{
  $stmt = $conn->prepare('SELECT * FROM USERS_ACTIVE');
  $stmt->execute();
  $users = $stmt->fetchAll();
  echo json_encode($users);
}catch(Exception $e){
  echo json_encode(["message" => $e->getMessage()]);
}