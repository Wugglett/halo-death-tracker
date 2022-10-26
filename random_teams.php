<!DOCTYPE HTML>

<link rel="stylesheet" href="styles.css">

<title> Team Randomizer </title>

<body>
<?php
	$mysqli = new mysqli("localhost", "root", "", "halo");
	
	$bois = array();
	$nums = array();
	
	$stmt = $mysqli->prepare("Select name FROM Bois");
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_row();
	
	while($row){
		do{
			$rand = rand(1, 4);
		}while(in_array($rand, $nums));
		array_push($nums, $rand);
		
		$bois[$rand] = $row[0];
		$row = $res->fetch_row();
	}
	
	echo('<p> Randomed Teams </p>');
	echo('<table><tr><td> Team 1 </td>');
	$i = 1;
	for($i; $i < 4/2 + 1; $i++){
		echo('<td>'.$bois[$i].'</td>');
	}
	echo('</tr><tr><td> Team 2 </td>');
	for($i; $i < 4+1; $i++){
		echo('<td>'.$bois[$i].'</td>');
	}
	echo('</tr></table>');
	echo('<form action="./random_teams.php" method="get"> <input type="submit" value="Randomize Again"/> </form>'.'<br>');
	
	echo('<form action="./game_session.php" method="get"> <input type="hidden" name="game_id" value="4" /> <input type="submit" value="Go To Halo CE"/> </form>');
	echo('<form action="./game_session.php" method="get"> <input type="hidden" name="game_id" value="5" /> <input type="submit" value="Go To Halo 2"/> </form>');
	
	echo('<p><a href="./index.php">Home</a></p>');
?>
</body>