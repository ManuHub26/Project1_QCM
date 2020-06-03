<html>
	<head>
		<meta charset="utf-8" />
		<title> QCM </title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
<?php
//print_r($_POST);

$id = mysqli_connect("localhost","root","","qcu");
mysqli_query($id,"SET NAMES 'utf8'");

  $total = 0;
  echo "<h1>Liste des questions ou vous avez une erreur :</h1>";
  foreach ( $_POST as $cle => $val )  {  
      
		//echo "<br>Question idq=$cle, reponse du joueur idr=$val<br>";
		$req = "select verite from reponses where idr=$val";
		$res = mysqli_query($id,$req);
		$ligne = mysqli_fetch_assoc($res);
		if($ligne["verite"]==1)
		{
			$total += 2;  //$total = $total + 2
		}else{
			$req2 = "select * from questions where idq = $cle";
			$res2 = mysqli_query($id,$req2);
			$ligne2 = mysqli_fetch_assoc($res2);
			echo "<div class='erreur'>".$ligne2["libelleQ"]."</div>";
			$req3 = "select * from reponses where idq=$cle and verite=1";
			$res3 = mysqli_query($id,$req3);
			$ligne3 = mysqli_fetch_assoc($res3);
			echo "<h3>Il fallait répondre : ".$ligne3["libeller"]."</h3>";
		}
      }  	
	echo "<br><br><br><h3> Votre resultat : $total / 20</h3>";
      
		
		
		
    
    
?>