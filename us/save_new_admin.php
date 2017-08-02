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

if(isset($_GET['admin_id'])){
    $admin_id= $_GET['admin_id'];
}


$admin = " ";
$sex =" ";
$date = " ";
$username = " ";
$password = " ";
$tel = " ";
$mail = " ";
$foto = " ";
$edit = "";

if(isset($_POST['admin_id'])){
    $admin_id = $_POST['admin_id'];
}

if(isset($_POST['sex'])){
    $sex = $_POST['sex'];
}

if(isset($_POST['username'])){
    $username = $_POST['username'];
}

if(isset($_POST['password'])){
    $password = $_POST['password'];
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

if($admin_id != Null){
	echo "ganaxele";
	$query = 'UPDATE admin SET `username` = "' .  $admin . '", `password` = "'. $admin. '",`username` = "'. $username. '",  `password` = "'. $password. '", `date` = "'. $date. '", `telephone` = "' . $tel. '", `email` = "'. $mail. '", `foto` = "'. $foto. '"  WHERE id ='. $admin_id. ';';
	echo $query;
	$result = mysqli_query($connection, $query);
	$url =  "add_new_admin.php?menu_id=${menu_id}&action_id=${action_id}&admin_id={$admin_id}";
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
//esta Linha é a mais importante pra fazer criar o logimn de usuario deixa só as variavei válidas amém
if($admin_id == Null){
	echo "axali";
	$query = 'INSERT INTO admin (`username`, `password`, `date`, `telephone`, `email`, `foto`) VALUES ("'. $username .'","'. $password .'","'. $date .'","' . $tel . '","'. $mail . '","'. $foto . '");';
	
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