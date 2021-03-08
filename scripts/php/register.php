<?php
session_start();
if(!isset($_POST['login'])){
    header("Location: ../../signup.php");
}
$login = $_POST['login'];
$email = $_POST['email'];
$pass1 = $_POST['pass'];
$pass2 = $_POST['pass2'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$role = $_POST['role'];


$isOK = true;
if(strlen($login)>20){
    $isOK = false;
    $_SESSION['e_login'] = "Login może posiadać max 20 znaków";
}
if(!ctype_alnum($login)){
    $isOK = false;
    $_SESSION['e_login'] = "Login może się składać tylko z liter i cyfr (baz polskich znaków)";
}

if(!ctype_alnum($name)){
    $isOK = false;
    $_SESSION['e_name'] = "W Imieniu masz chyba tylko litery, a nie jakieś znaki specjalne? Musi być bez polskich znaków";
}

if(!ctype_alnum($surname)){
    $isOK = false;
    $_SESSION['e_name'] = "W nazwisku masz chyba tylko litery, a nie jakieś znaki specjalne? Musi być bez polskich znaków";
}

if (strlen($pass1)<9){
	$isOK=false;
	$_SESSION['e_pass']="Hasło musi posiadać min. 9 znaków";
}
		
if ($pass1!=$pass2){
	$isOK=false;
	$_SESSION['e_pass']="Podane hasła nie są identyczne!";
}	

$emailS = filter_var($email, FILTER_SANITIZE_EMAIL);
if ((filter_var($emailS, FILTER_VALIDATE_EMAIL)==false) || ($emailS!=$email)){
	$wszystko_OK=false;
	$_SESSION['e_mail']="Podaj poprawny adres e-mail!";
}

if (!isset($_POST['ToS'])){
	$isOK=false;
	$_SESSION['e_ToS']="Potwierdź akceptację regulaminu!";
}

$sekret = "6LdnnD8aAAAAALsUgIfJGpbj9w6wjtc7G1BTO1_f";
$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
$odpowiedz = json_decode($sprawdz);
		
if ($odpowiedz->success==false){
	$wszystko_OK=false;
	$_SESSION['e_bot']="Potwierdź, że nie jesteś botem!";
}

switch($role){
    case "recruit":
    case "freelanc":
    break;
    default: $_SESSION['e_role'] = "Zła kategoria konta";
}

try{
    require_once "../../includes/connect.php";
    $db = new PDO($dsn, $db_user, $db_pass);
    
    $query = "SELECT id FROM users WHERE email = :mail";
    $polecenie = $db->prepare($query);
    $polecenie->bindParam(":mail", $emailS);
    $polecenie->execute();

    if($polecenie->rowCount() > 0){
        $isOK = false;
        $_SESSION['e_mail'] = "E-mail jest już zajęty";
    }

    
    $query = "SELECT id FROM users WHERE user = :nick";
    $polecenie = $db->prepare($query);
    $polecenie->bindParam(":nick", $login);
    $polecenie->execute();

    if($polecenie->rowCount() > 0){
        $isOK = false;
        $_SESSION['e_login'] = "Login jest już zajęty";
    }

    if($isOK){
        $desc = "";
        
        $hashPass = password_hash($pass1, PASSWORD_DEFAULT);
        $SLogin = htmlentities($login, ENT_HTML5, "UTF-8");
        $query = "INSERT INTO users VALUES(:id, :nick, :pass, :email, :firstname, :surname, :descript, :rola ,:specs, :isadmin)";
        $polecenie = $db->prepare($query);
        $polecenie->bindValue(":id", NULL);
        $polecenie->bindParam(":nick", $SLogin);
        $polecenie->bindParam(":pass", $hashPass);
        $polecenie->bindParam(":email", $emailS);
        $polecenie->bindParam(":firstname", $name);
        $polecenie->bindParam(":surname", $surname);
        $polecenie->bindParam(":descript", $desc);
        $polecenie->bindValue(":rola", $role);
        $polecenie->bindValue(":specs", $desc);
        $polecenie->bindValue(":isadmin", False);
        $polecenie->execute();
        $_SESSION['desription'] = $desc;
        $_SESSION['role'] = $assoc['role'];
        $_SESSION['loged'] = true;
        header("Location: ../../dlaUsera.php");
    }else{
        header("Location: ../../signup.php");
    }
    $db = NULL;

    
}catch(PDOException $e){
    echo "Napotkano Błąd serwera<br/>";
}