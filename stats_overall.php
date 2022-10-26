<!DOCTYPE HTML>

<link rel="stylesheet" href="styles.css">

<title> Best ofs </title>

<head> Overall Stats </head>

<body>
<?php

	$mysqli = new mysqli("localhost", "root", "", "halo");
	
	$stmt = $mysqli->prepare("SELECT name, total_deaths FROM Games WHERE total_deaths = (SELECT MAX(total_deaths) FROM Games)");
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	
	echo("<p> Highest Deaths: Game </p>"."<table><tr><td>".$row[0]."</td><td>".$row[1]."</td></tr></table>");
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$stmt = $mysqli->prepare("SELECT Missions.name, Missions.total_deaths, Games.name FROM Missions 
							INNER JOIN Games ON Missions.game_id = Games.id
							WHERE Missions.total_deaths = (SELECT MAX(total_deaths) FROM Missions)");
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	
	echo("<p> Highest Deaths: Mission </p>"."<table><tr><td>".$row[2]."</td><td>".$row[0]."</td><td>".$row[1]."</td></tr></table>");
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$stmt = $mysqli->prepare("SELECT name, deaths FROM Bois WHERE deaths = (SELECT MAX(deaths) FROM Bois)");
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	
	echo("<p> Highest Deaths: Player </p>"."<table><tr><td>".$row[0]."</td><td>".$row[1]."</td></tr></table>");
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	echo("<p> Average Deaths per Game: </p><table>");
	for($i = 4; $i < 10; $i++){
		for($j = 1; $j < 5; $j++){
			$stmt = $mysqli->prepare("SELECT AVG(Mission_Deaths.deaths), Bois.name, Games.name FROM Mission_Deaths 
									INNER JOIN Bois ON Mission_Deaths.boi_id = Bois.id
									INNER JOIN Missions ON Mission_Deaths.mission_id = Missions.id
									INNER JOIN Games ON Missions.game_id = Games.id
									WHERE Mission_Deaths.boi_id = ? AND Missions.game_id = ? AND Mission_Deaths.deaths != 0");
			$stmt->bind_param("ii", $j, $i);
			$stmt->execute();
			$res = $stmt->get_result();
			$row = $res->fetch_row();
			
			echo("<tr><td>".$row[2]."</td><td>".$row[1]."</td><td>".number_format($row[0], 2)."</td></tr>");
		}
	}
	echo("</table>");
	
	
	echo('</table>'.'<p><a href="./index.php">Home</a></p>');

?>
</body>