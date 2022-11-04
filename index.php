<!DOCTYPE HTML>

<head>

	<link rel="stylesheet" href="styles.css">
	<title> LASO Death Tracker </title>

</head>

<body>
	<div class="topContainer">
	<h1 class="title"> Halo LASO Deaths</h1>
<?php
	$mysqli = new mysqli("localhost", "root", "", "halo");
	
	echo("<form action=\"game_session.php\" method=\"get\">".
			'<select name="game_id" id="game_id">');
	$stmt = $mysqli->prepare("SELECT id , name FROM Games ORDER BY id");
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	while($row){
		printf("<option value=%d> %s </option>", $row[0], $row[1]);
		$row = $res->fetch_row();
	}
	echo('</select>');
	echo('<input class="btn" type="submit" value="Create Game Session"/>'.'</form>');
	
	echo("<form action=\"missions.php\" method=\"get\">".
			'<select name="game_id" id="game_id">');
	$stmt = $mysqli->prepare("SELECT id , name FROM Games ORDER BY id");
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	while($row){
		printf("<option value=%d> %s </option>", $row[0], $row[1]);
		$row = $res->fetch_row();
	}
	echo('</select>'.
			'<input class="btn" type="submit" value="Check Deaths"/>'.
			'</form>');

	echo("<form action=\"player_stats.php\" method=\"get\">".
			'<select name="boi_id" id="boi_id">');
	$stmt = $mysqli->prepare("SELECT id, name FROM Bois ORDER BY id");
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	while($row){
		printf("<option value=%d> %s </option>", $row[0], $row[1]);
		$row = $res->fetch_row();
	}
	echo('</select>');
	echo('<input class="btn" type="submit" value="Check Player Stats"/>'.'</form>');
			
	echo('<form action="stats_overall.php" method="post"> <input class="btn" type="submit" value="Check Overall Stats"/> </form>');
	
	echo('<form action="random_teams.php" method="post"> <input class="btn" type="submit" value="Randomize Teams"/> </form>');
?>
</div>
</body>