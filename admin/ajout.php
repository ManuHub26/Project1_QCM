<?php

session_start();

        $id = mysqli_connect("localhost","root","","qcu");

        if(isset($_POST["choixNiv"]) || isset($_POST["ajoutQuestion"]))
        {
            $niv = $_POST["choixNiv"]; 
            $_SESSION['q'] = $_POST["ajoutQuestion"];
            $q = $_SESSION['q'];

            $req = "insert into questions(libelleQ,niveau) 
                    values('$q','$niv')";
            
            
            mysqli_query($id,$req);    
                
            header('Location:ajout.php?r');
        }
        else
        if(isset($_POST["ajoutRepTrue"]))
          {
            $q = $_SESSION['q'];
            
            $select = "select * from questions
                       where libelleQ like '$q'";

                $res = mysqli_query($id,$select);
                $ligne = mysqli_fetch_assoc($res);
                $idq = $ligne["idq"];
                
                $repTrue = $_POST["ajoutRepTrue"] ;
                $repFalse1 = $_POST['ajoutRepFalse1'];
                $repFalse2 = $_POST['ajoutRepFalse2'];
                $repFalse3 = $_POST['ajoutRepFalse3'];

                $rep = "insert into reponses(idq,libeller,verite)
                         values('$idq','$repTrue','1'),
                               ('$idq','$repFalse1','0'),
                               ('$idq','$repFalse2','0'),
                               ('$idq','$repFalse3','0')";
            
              mysqli_query($id,$rep);
            
               echo "<h3 id='mess_insert'> insertion des réponses réussie !</h3></br></br>";
               
               
          }
              
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Ajouter Admin</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>  
 
    
<?php

  if(isset($_GET['r']))
   {

?>
  <h3 id='mess_insert'> La question a bien été enregistré ! Inscriver maintenant les réponses</h3></br></br>

    <form action="ajout.php"  method="post">

      <label for="ajoutRepTrue">Réponse vraie :</label>        
      <input type="text" name="ajoutRepTrue" id="ajoutRepTrue"><br><br>

      <label for="ajoutRepFalse1">Réponse fausse 1 :</label>
      <input type="text" name="ajoutRepFalse1" id="ajoutRepFalse1"><br><br>

      <label for="ajoutRepFalse2">Réponse fausse 2 :</label>
      <input type="text" name="ajoutRepFalse2" id="ajoutRepFalse2"><br><br>

                  
      <label for="ajoutRepFalse3">Réponse fausse 3 :</label>
      <input type="text" name="ajoutRepFalse3" id="ajoutRepFalse3"><br><br>

      <input type="submit" id="submit" value="Envoyer"> 

    </form> 

<?php            
   }
?>

<?php
  if(isset($_GET['q']))
  {
?>
  <h1>Ajouter déjà une question avec sa difficultée</h1><br><br>
      <form action="ajout.php"  method="post">

          <label for="choixNiv">Débutant</label>
          <input type="radio" name="choixNiv" id="deb" value="0"><br><br>
          
          <label for="choixNiv">Confirmé</label>
          <input type="radio" name="choixNiv" id="conf" value="1"><br><br>

          <label for="ajoutQuestion">Question :</label>
          <input type="text" name="ajoutQuestion" id="ajoutQuestion"><br><br>

          <input type="submit" id="submit" value="Envoyer">  
    
      </form>
<?php
  }
?>


</body>
</html>


