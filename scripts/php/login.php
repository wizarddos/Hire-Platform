<?php
session_start();
if(!isset($_POST['pass'])){
    header("Location: index.html");
    exit();
}

$login = $_POST['login'];
$pass = $_POST['pass'];
$login = htmlentities($login, ENT_HTML5, "UTF-8");
$pass = htmlentities($pass, ENT_HTML5, "UTF-8");
require_once "../../includes/connect.php";
try{
    $db = new mysqli($host, $db_user,$db_pass, $db_name);
    if(!$db->connect_errno == 0){
        throw new Exception("connection error");
    }else{
        $query = "SELECT * FROM users WHERE user = ?";
        if(!$exec = $db->prepare($query)){
            throw new mysqli_sql_exception("Query prepare error");
        }else{
            $exec->bind_param("s", $login);
            $exec->execute();
            $res = $exec->get_result();
            $assoc = $res->fetch_assoc();
            if($res->num_rows != 0){
                if(!password_verify($pass,$assoc['pass'])){
                    $_SESSION['error'] = "nieprawidłowy login lub hasło";
                    header("Location: ../../index.html");
                }else{
                    $_SESSION['nick'] = $assoc['user'];
                    if($assoc['isAdmin']){
                        header("Location: AdminPanel.php");
                    }else{
                        header("Location: dlaUsera.php");
                    }
                }
            }else{
                $_SESSION['error'] = "nieprawidłowy login lub hasło";
                header("Location: ../../index.html");
            }
        }
    }
}catch(Exception $e){
    echo $e;
}catch(mysqli_sql_exception $e){
    echo $e;
}