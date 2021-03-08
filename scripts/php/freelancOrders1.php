<?php
session_start();
require_once "../../includes/connect.php";
try{
    $id = $_SESSION['id'];
    $db = new PDO($dsn, $db_user, $db_pass);
    
    $query = "SELECT * FROM orders WHERE idwykonujacego = :id";
    $prepared = $db->prepare($query);
    $prepared->bindParam(":id", $id);
    $prepared->execute();
    $result = $prepared->fetch(PDO::FETCH_OBJ);
    $rows = $prepared->fetchAll();
    if(count($rows) == 0){
        echo "nic nie znaleziono";
    }else{
        while($result){
    
        }
    }
    
}catch(PDOException $e){
    echo "błąd serwera, Przepraszamy za niedogodności";
}