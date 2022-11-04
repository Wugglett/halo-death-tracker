<!DOCTYPE HTML>

<head>

	<link rel="stylesheet" href="styles.css">
	<title> LASO Session </title>

</head>

<body>
	<h1 class="title">Mission Session</h1>
<?php
	$mission_id = $_GET['mission_id'];
	$game_id = $_GET['game_id'];

	$mysqli = new mysqli("localhost", "root", "", "halo");
	
	$stmt = $mysqli->prepare("SELECT Games.name FROM Games WHERE id = ?");
	$stmt->bind_param('i', $game_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	echo('<h2>'.$row[0].': ');
	
	$stmt = $mysqli->prepare("SELECT Missions.name, Missions.total_deaths FROM Missions WHERE id = ?");
	$stmt->bind_param('i', $mission_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	echo($row[0].'</h2><h3> Mission Deaths: '.$row[1].'</h3>');
	
	$stmt = $mysqli->prepare("SELECT Bois.name, Mission_Deaths.deaths, Bois.id FROM Bois
							INNER JOIN Mission_Deaths ON Bois.id = Mission_Deaths.boi_id
							WHERE Mission_Deaths.mission_id = ?");
	$stmt->bind_param("i", $mission_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	
	echo('<table><tr>');
	while($row){
		$boi_id = $row[2];
		echo('<td>'.$row[0].": ".$row[1].'<form action="session_add.php" method="post">'.
										'<input type="hidden" name="deaths" id="deaths" value="1"/>'.
										"<input type=\"hidden\" name=\"game_id\" id=\"game_id\" value=\"$game_id\"/>".
										"<input type=\"hidden\" name=\"mission_id\" id=\"mission_id\" value=\"$mission_id\"/>".
										"<input type=\"hidden\" name=\"boi_id\" id=\"boi_id\" value=\"$boi_id\"/>".
										'<input class="btn" type="submit" value="Add Death"/> </form>');
		echo('<form action="session_sub.php" method="post">'.
										'<input type="hidden" name="deaths" id="deaths" value="-1"/>'.
										"<input type=\"hidden\" name=\"game_id\" id=\"game_id\" value=\"$game_id\"/>".
										"<input type=\"hidden\" name=\"mission_id\" id=\"mission_id\" value=\"$mission_id\"/>".
										"<input type=\"hidden\" name=\"boi_id\" id=\"boi_id\" value=\"$boi_id\"/>".
										'<input class="btn" type="submit" value="Subtract Death"/> </form>'."</td>");
		$row = $res->fetch_row();
	}
	echo('</tr></table>');
	
	echo("<form action=\"game_session.php\" method=\"get\"> <input type=\"hidden\" name=\"game_id\" id=\"game_id\" value=\"$game_id\"/> <input type=\"submit\" value=\"Back to Mission select\"/> </form>");
	
	echo('<a class="home" href="./index.php">Home</a>');
?>
</table>
</body>