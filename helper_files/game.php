<?php
	$game = $_POST['game'];

	$mysqli = new mysqli("localhost", "root", "", "halo");
	
	$stmt = $mysqli->prepare("INSERT INTO Games(name) VALUES(?)");
	$stmt->bind_param('s', $game);
	$stmt->execute();
	
	for($i = 0; $i < 4; $i++){
		$stmt = $mysqli->prepare("INSERT INTO Game_Deaths(boi_id, game_id) VALUES(?,?)");
		$stmt->bind_param("ii", $i+1, $game_id);
		$stmt->execute();
	}
	
	header("Location: ./game.html");
	exit();
?>