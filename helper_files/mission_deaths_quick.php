<?php
	$mysqli = new mysqli("localhost", "root", "", "halo");
	
	for($i = 26; $i < 35; $i++){
		for($j = 1; $j < 5; $j++){
			$stmt = $mysqli->prepare("INSERT INTO Mission_Deaths(boi_id, mission_id) VALUES(?,?)");
			$stmt->bind_param("ii", $j, $i);
			$stmt->execute();
		}
	}
	
	header("Location: ./index.php");
	exit();
?>