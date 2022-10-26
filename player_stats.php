<!DOCTYPE HTML>

<link rel="stylesheet" href="styles.css">

<title> Player Stats </title>

<head> Death Stats for </head>

<?php
	$boi_id = $_GET['boi_id'];

	$mysqli = new mysqli("localhost", "root", "", "halo");
	
	$stmt = $mysqli->prepare("SELECT Bois.name, Bois.deaths FROM Bois WHERE id = ?");
	$stmt->bind_param('i', $boi_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	$boi_name = $row[0];
	echo($boi_name.'<body>');
	
	echo('<p><a> Total Deaths </a></p>');
	echo('<table><tr><td>'.$boi_name.'</td><td>'.$row[1].'</td></tr></table>');
	
	echo('<p> Game Deaths for '.$boi_name.'</p>');
	
	$stmt = $mysqli->prepare("SELECT Games.name, Game_Deaths.deaths FROM Bois
							INNER JOIN Game_Deaths ON Bois.id = Game_Deaths.boi_id
							INNER JOIN Games ON Game_Deaths.game_id = Games.id
							WHERE Bois.id = ?
							ORDER BY Games.id");
	$stmt->bind_param('i', $boi_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	
	echo('<table>');
	while($row){
		echo('<tr><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>');
		$row = $res->fetch_row();
	}
	echo('</table>');
	
	echo('<p> Mission Deaths for '.$boi_name.'</p>');
	
	$stmt = $mysqli->prepare("SELECT Missions.name, Games.name, Mission_Deaths.deaths FROM Missions 
							INNER JOIN Mission_Deaths ON Mission_Deaths.mission_id = Missions.id
							INNER JOIN Games ON Games.id = Missions.game_id
							WHERE Mission_Deaths.boi_id = ?
							ORDER BY Games.id");
	$stmt->bind_param('i', $boi_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	$game_name = $row[1];
	
	echo("<p>$game_name</p>");
	echo('<table>');
	while($row){
		if($game_name != $row[1]){
			echo("</table>"."<p>$game_name</p>");
			echo('<table>');
			$game_name = $row[1];
		}
		echo('<tr><td>'.$row[1].'</td><td>'.$row[0].'</td><td>'.$row[2].'</td></tr>');
		$row = $res->fetch_row();
	}
	echo('</table>');
	
	echo('</table>'.'<p><a href="./index.php">Home</a></p>');
	
?>
</body>