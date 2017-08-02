<?php
session_start();
if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
else
	header('Location: ../index.php');

require_once("../db/db.php");

if(isset($_GET['admin_id'])){
    $admin_id = $_GET['admin_id'];
}

if(isset($_GET['menu_id'])){
    $menu_id = $_GET['menu_id'];
}

if(isset($_GET['action_id'])){
    $action_id = $_GET['action_id'];
}


if($admin_id){
	$query = 'DELETE FROM admin WHERE `id` = ' . $admin_id .';';
	echo $query;
	$result = mysqli_query($connection, $query);
		   
	if(!$result){
		die('QUERY FAILED' . mysqli_errno());
	}
	else{
		$url =  "index.php?menu_id=${menu_id}&action_id=${action_id}";
		header('Location: '.$url);
		//echo $url;
	}
}


?>