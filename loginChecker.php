<?php

include('config/connection.php');
session_start();

if(isset($_POST['action']) && $_POST['action'] == 'login') {
	
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	
	$stmt = $dbc->prepare("SELECT id FROM users WHERE username=? AND password=? AND status=1");
    $stmt->bind_param("ss",$username, $password);
	$search = $stmt->execute();
	$stmt->store_result();
	$match = $stmt->num_rows;
	if($match == 1){
		$stmt->bind_result($temp);
		$stmt->fetch();
		$_SESSION['id'] = $temp;
		//$_SESSION['email'] = $_POST['email'];
		echo 1;
	} else {
		echo 0;
	}
	
} 


?>