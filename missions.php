<!DOCTYPE HTML>

<link rel="stylesheet" href="styles.css">

<title> Stats Check </title>

<head> Death Stats for </head>

<?php
	$game_id = $_GET['game_id'];

	$mysqli = new mysqli("localhost", "root", "", "halo");
	
	$stmt = $mysqli->prepare("SELECT Games.name, Games.total_deaths FROM Games WHERE id = ?");
	$stmt->bind_param('i', $game_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	$game_name = $row[0];
	echo($game_name.'<body>');
	
	echo('<p><a> Total Deaths </a></p>');
	echo('<table><tr><td>'.$game_name.'</td><td>'.$row[1].'</td></tr></table>');
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	echo('<p> Player Deaths for '.$game_name.'</p>');
	
	$stmt = $mysqli->prepare("SELECT Bois.name, Games.name, Game_Deaths.deaths FROM Bois
							INNER JOIN Game_Deaths ON Bois.id = Game_Deaths.boi_id
							INNER JOIN Games ON Game_Deaths.game_id = Games.id
							WHERE Games.id = ?
							ORDER BY Bois.id");
	$stmt->bind_param('i', $game_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	
	echo('<table>');
	while($row){
		echo('<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td></tr>');
		$row = $res->fetch_row();
	}
	echo('</table>');
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	echo('<p> Total Mission Deaths for '.$game_name.'</p>');
	
	$stmt = $mysqli->prepare("SELECT Missions.name, Missions.total_deaths FROM Missions WHERE game_id = ?");
	$stmt->bind_param('i', $game_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	
	echo('<table>');
	while($row){
		echo('<tr><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>');
		$row = $res->fetch_row();
	}
	echo('</table>');
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	echo('<p> Player Mission Deaths for '.$game_name.'</p>');
	
	$stmt = $mysqli->prepare("SELECT Bois.name, Missions.name, Mission_Deaths.deaths FROM Bois
							INNER JOIN Mission_Deaths ON Bois.id = Mission_Deaths.boi_id
							INNER JOIN Missions ON Mission_Deaths.mission_id = Missions.id
							WHERE Missions.game_id = ?
							ORDER BY Missions.id");
	$stmt->bind_param('i', $game_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	$mission_name = "";
	
	echo('<table>');
	while($row){
		if($mission_name != $row[1]){
			echo('</table>');
			$mission_name = $row[1];
			echo("<br><p1> $mission_name: </p1>");
			echo('<table>');
		}
		echo('<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td></tr>');
		$row = $res->fetch_row();
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	echo('</table>'.'<p><a href="./index.php">Home</a></p>');
	
?>
</body>