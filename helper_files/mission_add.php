<!DOCTYPE HTML>

<title> Mission Addition </title>

<head> Add a Mission </add>

<body>
	<form action="mission_add_insert.php" method="post">
			<input type="text" name="mission" id="mission" placeholder="Mission name" />
			<select name="game_id" id="game_id">
<?php
	$mysqli = new mysqli("localhost", "root", "", "halo");

	$stmt = $mysqli->prepare("SELECT id , name FROM Games ORDER BY id");
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	while($row){
		printf("<option value=%d> %s </option>", $row[0], $row[1]);
		$row = $res->fetch_row();
	}
	
?>
			</select><br>
			<input type="submit" value="Add Mission">
	</form>
	
	<p><a href="./index.php">Home</a></p>
	
</body>