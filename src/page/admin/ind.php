<!-- page admin pour l'insertion des donnees test dans la base de donnee -->
<?php 
session_start() ;
if( isset($_SESSION['admin']) && isset($_SESSION['pass']) ){
  $admin_name = $_SESSION['admin'] ;
  } else {
    header('location:../index.php') ;
  }
  require '../../app/database/cnx.php' ;
  require '../../app/autoloader/autoload.php' ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>admin</title>
  <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
<?php ?>
<?php
if ( isset($_POST['envlogo']) ){ // insertion logo debut

  if( !empty($_POST['modele']) && !empty($_FILES['logo']['name']) ) {

    // logo

  } else {

    $message1 = '<p class="error">completer tous les champs</p>' ;

  }
// insertion logo fin

} elseif ( isset($_POST['envcar']) ){// insertion vehicule debut

  if( !empty($_POST['marque']) && !empty($_FILES['vehicule']['name']) && !empty($_POST['modeleID']) ) {

// insert vehicule    

  } else {

    $message2 = '<p class="error">completer tous les champs</p>' ;

  }
// insertion vehicule fin

} elseif ( isset($_POST['envimg']) ){ // insertion image secondaire debut

if( !empty($_FILES['imageSec']['name']) && !empty($_POST['marqueID']) ) {

    // insert image secondaire
  } else {

    $message3 = '<p class="error">completer tous les champs</p>' ;

  }
// insertion image secondaire fin
}
?>

  <h1 class="h1">insere les donnees</h1>
  
<?php include('_nav.php') ; ?>

  <div class="contenaire">
  
  <!-- insertion des logo -->
    <div>
  
<?php if( isset($message1) ){ echo $message1 ; }else{ ?>

          <h2>insere un modele</h2>

<?php } ?>

      <form action="" method="post" enctype="multipart/form-data">
        <label for="logo">associer un logo &darr;&darr;&darr; </label>
        <input type="file" name="logo" id="logo">
        <input type="text" name="modele" placeholder="entre un modele...">
        <input type="submit" name="envlogo" value="envoyer">
      </form>
    </div>
  <!-- insertion des logo -->

  <!-- insertion vehicule -->
    <div>
    
<?php if( isset($message2) ){ echo $message2 ; }else{ ?>

          <h2>insere un vehicule</h2>

<?php } ?>
    
      <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="vehicule">
        <input type="text" name="marque" placeholder="entre une marque...">
        <label for="modele">associer a un modele &darr;&darr;&darr; </label>
        <select name="modeleID" id="modele">
          <option value="" disable selected>-- selectionne un modele --</option>

<?php 
$sql = "SELECT modeleID, modele FROM logo" ;
$req = $cnx->prepare($sql) ;
$req->execute() ; 
while($data = $req->fetch(PDO::FETCH_OBJ)) {
?>

          <option value="<?= $data->modeleID ; ?>"><?= $data->modele ; ?></option> 

<?php } if( !isset($data) ) { ?>

          <option value="" disable selected>-- aucun modele --</option>

<?php } ?>

        </select>
        <input type="submit" name="envcar" value="envoyer">
      </form>

    </div>
  <!-- insertion vehicule -->
  
  <!-- insertion image secondaire -->
    <div>
      
<?php if( isset( $message3 ) ){ echo $message3 ; }else{ ?>

          <h2>entre une image</h2>

<?php } ?>

      <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="imageSec">
        <label for="marque">associer a une marque &darr;&darr;&darr; </label>
        <select name="marqueID" id="marque">
          <option value="" disable selected>-- selectionne un modele --</option>
<?php 
$sql = "SELECT marqueID, marque FROM vehicule" ;
$req = $cnx->prepare($sql) ;
$req->execute() ; 
while($data = $req->fetch(PDO::FETCH_OBJ)) { 
?>

          <option value="<?= $data->marqueID ; ?>"><?= $data->marque ; ?></option>

<?php }if( !isset($data) ) { ?>

          <option value="" disable selected>-- aucun marque --</option>

<?php } ?>

        </select>
        <input type="submit" name="envimg" value="envoyer">
      </form>
    </div>
  <!-- insertion image secondaire -->
  </div>

<?php ?>
  <script src="https://kit.fontawesome.com/a6b68e8c8c.js" crossorigin="anonymous"></script>
</body>
</html>