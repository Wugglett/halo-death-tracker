<?php
	$boi = $_POST['boi'];

	$mysqli = new mysqli("localhost", "root", "", "halo");
	
	$stmt = $mysqli->prepare("INSERT INTO Bois(name) VALUES(?)");
	$stmt->bind_param('s', $boi);
	$stmt->execute();
	
	header("Location: ./boi_add.html");
	exit();
?>