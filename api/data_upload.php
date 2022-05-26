<?php
require_once "config.php";
header('Content-Type: application/json; charset=utf-8');

if(isset($_GET['user']) || isset($_GET['value'])){
  $user = $_GET['user'];
  $value = $_GET['value'];

  try{
    $stmt = $conn->prepare('INSERT INTO USERS_ACTIVE (username, value_r) VALUES (:name, :value)');
    $stmt->bindParam(':name', $user);
    $stmt->bindParam(':value', $value);
    $stmt->execute();
    echo json_encode(["message"=>"success"]);
  }catch(Exception $e){
    echo json_encode($e->getMessage());
  }

}
