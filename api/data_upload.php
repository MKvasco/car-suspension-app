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
    $user_id = $conn->lastInsertId();
    echo json_encode(
      ["message"=>"upload success",
       "user_id"=>$user_id]
      );
  }catch(Exception $e){
    echo json_encode($e->getMessage());
  }

}

if(isset($_GET['id'])){
  $user_id = $_GET['id'];

  try{
    $stmt = $conn->prepare('DELETE FROM USERS_ACTIVE WHERE id=:id');
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    echo json_encode(
      ["message"=>"delete success"]
      );
  }catch(Exception $e){
    echo json_encode($e->getMessage());
  } 
}

if(isset($_GET['command'])){
  $command = $_GET['command'];

  try{
    $stmt = $conn->prepare('INSERT INTO SYSTEM_LOGS (command) VALUES (:command)');
    $stmt->bindParam(':command', $command);
    $stmt->execute();
    echo json_encode(
      ["message"=>"data logs upload success"]
      );
  }catch(Exception $e){
    echo json_encode($e->getMessage());
  } 
}
