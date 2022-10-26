<?php
	$mission = $_POST['mission'];
	$game_id = $_POST['game_id'];

	$mysqli = new mysqli("localhost", "root", "", "halo");
	
	$stmt = $mysqli->prepare("INSERT INTO Missions(name, game_id) VALUES(?, ?)");
	$stmt->bind_param('si', $mission, $game_id);
	$stmt->execute();
	
	$mission_id = $mysqli->insert_id;
	
	for($i = 1; $i < 5; $i++){
		$stmt = $mysqli->prepare("INSERT INTO Mission_Deaths(boi_id, mission_id) VALUES(?,?)");
		$stmt->bind_param("ii", $i, $mission_id);
		$stmt->execute();
	}
	
	header("Location: ./mission_add.php");
	exit();
?>