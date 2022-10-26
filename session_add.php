<?php
	$deaths = $_POST['deaths'];
	$boi_id = $_POST['boi_id'];
	$game_id = $_POST['game_id'];
	$mission_id = $_POST['mission_id'];

	$mysqli = new mysqli("localhost", "root", "", "halo");

	$stmt = $mysqli->prepare("UPDATE Mission_Deaths SET deaths = deaths + ? WHERE boi_id = ? AND mission_id = ?");
	$stmt->bind_param("iii", $deaths, $boi_id, $mission_id);
	$stmt->execute();
	
	$stmt = $mysqli->prepare("UPDATE Game_Deaths SET deaths = deaths + ? WHERE boi_id = ? AND game_id = ?");
	$stmt->bind_param("iii", $deaths, $boi_id, $game_id);
	$stmt->execute();
	
	$stmt = $mysqli->prepare("UPDATE Bois SET deaths = deaths + ? WHERE id = ?");
	$stmt->bind_param("ii", $deaths, $boi_id);
	$stmt->execute();
	
	$stmt = $mysqli->prepare("UPDATE Games SET total_deaths = total_deaths + ? WHERE id = ?");
	$stmt->bind_param("ii", $deaths, $game_id);
	$stmt->execute();
	
	$stmt = $mysqli->prepare("UPDATE Missions SET total_deaths = total_deaths + ? WHERE id = ?");
	$stmt->bind_param("ii", $deaths, $mission_id);
	$stmt->execute();
	
	header("Location: ./session.php?game_id=$game_id&mission_id=$mission_id");
	exit();
?>