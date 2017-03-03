<?php 

	$db = new mysqli('localhost', 'admin', 'q1W@e3R$t5', 'sporcondb');
	if($db->connect_errno) {
		die("Connection failed".$mysqli->connect_error);
	}

?>