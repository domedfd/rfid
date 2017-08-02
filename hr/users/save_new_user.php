<?php
session_start();

if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
else
	header('Location: ../index.php');

header("Content-type: text/html; charset=utf-8");
require_once("../db/db.php");

if(isset($_GET['menu_id'])){
    $menu_id = $_GET['menu_id'];
}

if(isset($_GET['action_id'])){
    $action_id = $_GET['action_id'];
}

if(isset($_GET['users_id'])){
    $user_id= $_GET['user_id'];
}


$user = " ";
$username = " ";
$password = " ";
$sex =" ";
$date = " ";
$tel = " ";
$mail = " ";
$foto = " ";
$edit = "";

if(isset($_POST['username'])){
    $users = $_POST['username'];
}

if(isset($_POST['sex'])){
    $sex = $_POST['sex'];
}

if(isset($_POST['username'])){
    $sex = $_POST['username'];
}

if(isset($_POST['password'])){
    $sex = $_POST['password'];
}

if(isset($_POST['date'])){
    $date = $_POST['date'];
}

if(isset($_POST['tel'])){
    $tel = $_POST['tel'];
}

if(isset($_POST['email'])){
    $mail = $_POST['email'];
}

if(isset($_POST['email'])){
    $foto = $_POST['foto'];
}

if($employee_id != Null){
	echo "ganaxele";
	$query = 'UPDATE users SET `username` = "' .  $username . '", `password` = "' .  $password . '", `date` = "'. $date. '", `telephone` = "' . $tel. '", `email` = "'. $mail. '", `foto` = "'. $foto. '"  WHERE id ='. $users_id. ';';
	echo $query;
	$result = mysqli_query($connection, $query);
	$url =  "add_new_user.php?menu_id=${menu_id}&action_id=${action_id}&user_id={$user_id}";
	if(!$result){
		$_SESSION["edited"] = "fail";
		header('Location: '.$url);
		//die('QUERY FAILED' . mysqli_errno());
	}
	else{
		$_SESSION["edited"] = "success";
		header('Location: '.$url);
		//echo $url;
	}
}

if($users_id == Null){
	echo "axali";
	$query = 'INSERT INTO users (`username`, `password`, `date`, `telephone`, `email`, `foto`) VALUES ("'. $users . '","'. $username . $password .$date .'","' . $tel . '","'. $mail . '","'. $foto . '");';
	
	$result = mysqli_query($connection, $query);
	$url =  "index.php?menu_id=${menu_id}&action_id=${action_id}";
	
	echo $query;
	//$query = "UPDATE new_cards SET `card_id` = Null WHERE id = 1;";
	
	if(!$result){
		header('Location: '.$url);
		//die('QUERY FAILED' . mysqli_errno());
	}
	else{
		header('Location: '.$url);
	//	//echo $url;
	}
}

?>