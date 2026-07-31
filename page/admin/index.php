<?php 
require '../../app/database/cnx.php' ;
require '../../app/autoloader/autoload.php' ;
loadFile('app', 'database', 'index') ;
// loadFile('app', 'database', 'index') ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>admin</title>
</head>
<body>
  <h3>page admin</h3>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="modele" placeholder="modele">
    <input type="file" name="logo">
    <input type="submit" name="envoyer" value="envoyer">
  </form>
  <?php

  $dossierTempo = $_FILES['logo']['tmp_name'];
  $dossierSite = '../../public/image/db/logo/' . $_FILES['logo']['name'];
  $deplace = move_uploaded_file($dossierTempo, $dossierSite);

  // $extension = strrchr($_FILES['logo']['name'], '.');
  if(isset($_POST['envoyer'])) {

    if(empty($_POST['modele']) || empty($_FILES['logo']['name'])) {
      echo "veuillez remplir tous les champs" ;
    } else {

      if($deplace) {
        
        $image = $_FILES['logo']['name'] ;

        $sql = "INSERT INTO logo (modele, logo)
            VALUES (:modele, :logo)" ;
        $req = $cnx->prepare($sql) ;
        $retour = $req->execute(array(
          ':modele' => $_POST['modele'],
          ':logo' => $image
          )) ;

          if($retour) {
            echo "insertion reussie" ;
          }else {
            echo "erreur d'insertion" ; 
          }
          
          }
          
    }

  }
  ?>
</body>
</html>