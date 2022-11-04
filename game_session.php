<!DOCTYPE HTML>

<head>

	<link rel="stylesheet" href="styles.css">
	<title> Mission Select </title>

</head>

<body>
<?php
	$game_id = $_GET['game_id'];

	$mysqli = new mysqli("localhost", "root", "", "halo");

	$stmt = $mysqli->prepare("SELECT Games.name FROM Games WHERE Games.id = ?");
	$stmt->bind_param('i', $game_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	echo('<h1 class="title">Select a mission from '.$row[0].'</h1>');

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
	echo('<input class="btn" type="submit" value="Create Mission Session"/>'.
		'</form><br>');
		
	echo('<a class="home" href="./index.php">Home</a>');
?>
</body>