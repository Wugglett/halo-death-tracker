<!DOCTYPE HTML>

<link rel="stylesheet" href="styles.css">

<title> Mission Select </title>
<center>
<head> Select a Mission from </head>

<?php
	$game_id = $_GET['game_id'];

	$mysqli = new mysqli("localhost", "root", "", "halo");

	$stmt = $mysqli->prepare("SELECT Games.name FROM Games WHERE Games.id = ?");
	$stmt->bind_param('i', $game_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	echo($row[0].'<body>');

	$stmt = $mysqli->prepare("SELECT Bois.name, Game_Deaths.deaths FROM Bois
							INNER JOIN Game_Deaths ON Bois.id = Game_Deaths.boi_id
							WHERE Game_Deaths.game_id = ?");
	$stmt->bind_param("i", $game_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	
	echo('<table><tr>');
	while($row){
		echo('<td>'.$row[0].": ".$row[1]."</td>");
		$row = $res->fetch_row();
	}
	echo('</tr></table>');


	echo("<form action=\"session.php\" method=\"get\">".
		"<input type=\"hidden\" name=\"game_id\" id=\"game_id\" value=\"$game_id\"/>".
		'<select name="mission_id" id="mission_id">');
			
	$stmt = $mysqli->prepare("SELECT id, name FROM Missions WHERE game_id = ?");
	$stmt->bind_param("i", $game_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	while($row){
		printf("<option value=%d> %s </option>", $row[0], $row[1]);
		$row = $res->fetch_row();
	}
	echo('</select><br>');
	echo('<input type="submit" value="Create Mission Session"/>'.
		'</form><br>');
		
	echo('<p><a href="./index.php">Home</a></p>');
?>
</body>