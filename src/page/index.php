<?php
session_start() ;

require('../app/database/cnx.php') ;
$message= "<p>identifier vous</p>" ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>connexion</title>
  <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
<?php 
if(isset($_POST['connexion'])) {
  
  if(empty($_POST['pseudo']) || empty($_POST['pass'])) {

    $message = '<p class="error">vieller remplis tous le champs</p>' ;

    }else{

    $sql = "SELECT pseudo, pass FROM admin
            WHERE pseudo = :pseudo AND pass = :pass" ;

    $req = $cnx->prepare($sql) ;

    $req->execute(array(
      ':pseudo' =>  $_POST['pseudo'],
      ':pass' =>  $_POST['pass']
    )) ;

    $count = $req->rowCount() ;
    if( $count > 0) {

      $data = $req->fetch(PDO::FETCH_OBJ) ;
      
          if(isset($_POST['memoire'])){
              setcookie('memoire', $data->pseudo, time() + 3600 * 24 * 365, '/') ;
            }else{
                setcookie('memoire', $data->pseudo, time() - 1, '/') ;
            }
              $_SESSION['admin'] =  $_POST['pseudo'] ;
              $_SESSION['pass'] =  $_POST['pass'] ;
              header('location:/page/admin') ;
              exit ;
    
    }else{
      $message = '<p class="error">vieller remplir les identifiant correct</p>' ;
    }
  }
}
?>
    <div class="admin-form">
      <form action="" method="post">
        <?= $message ; ?>
        <label for="pseudo">pseudo</label>
        <input type="text" name="pseudo" placeholder="admin" id="pseudo">

        <label for="pass">mot de passe</label>
        <input type="text" name="pass" placeholder="mot de passe" id="pass">

        <input type="submit" name="connexion" value="valider">

        <label for="memoire">se souvernir de moi</label>
        <input type="checkbox" name="memoire" id="memoire">
      </form>
    </div>
</body>
</html>