<html>
	<head>
		<meta charset="utf-8" />
		<title> QCM </title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
	<center>
	<h1> Bienvenue dans mon QCM </h1>
	<?php 
	if(!isset($_POST["b1"]))
		{
	?>
	<h3> Selectionnez votre niveau : </h3>
	<form action="aideQcm.php" method="post">
	<input type="radio" name="niveau" value="0" checked > Débutant &nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="niveau" value="1"> Confirmé &nbsp;&nbsp;&nbsp;&nbsp;
	<br><br><br><input type="submit" value="Ok" name="b1">
	</form>
 	
	<?php
		}else{
	echo "</center>";
	$niveau = $_POST["niveau"];
	$id = mysqli_connect("localhost","root","","qcu");
	mysqli_query($id,"SET NAMES 'utf8'");
	$req = "select * from questions where niveau = $niveau
			order by rand() limit 10";
	$res = mysqli_query($id,$req);
	$cpt = 1;
	?>
	<form action="resultat.php" method="post">
	<?php
	while($ligne = mysqli_fetch_assoc($res)){
		echo "<h3>Question $cpt: ".$ligne["libelleQ"]."<br></h3>";
		$cpt++;
		$req2 = "select * from reponses where idq=".$ligne["idq"];
		$res2 = mysqli_query($id,$req2);
		while($ligne2 = mysqli_fetch_assoc($res2)){
			?>
			<input type="radio" name="<?=$ligne["idq"];?>" 
											value="<?=$ligne2["idr"];?>">
			<?php
			echo $ligne2["libeller"]."<br>";
		}
	}
	
	?>
	<br><br><br>
	
	<input type="submit" value="Envoyer">
	<?php 
		}
	?>
	
	
	
	