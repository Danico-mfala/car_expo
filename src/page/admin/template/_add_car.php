<?php
require ('../../app/database/cnx.php') ;
require_once ('../admin/function/_func_query.php') ;

// insertion du vehicule debut
if( isset($_POST['sendNewCar']) ) {
  if( !empty($_POST['km']) && !empty($_POST['prix']) && !empty($_POST['edition']) && !empty($_POST['etat']) && !empty($_POST['modele']) ) { // tous le champs rempli
      if( !empty($_FILES['vehicule']['name']) && !empty($_FILES['avant']['name']) && !empty($_FILES['arriere']['name']) && !empty($_FILES['interieur']['name']) && !empty($_FILES['tableau']['name']) ) { /* toutes les image inserer */
        // fonctions insertion du vehicules 
        $message1 = '<p class="success">donnee envoyer avec succes</p>' ;
      } else {
        $message1 = '<p class="error">inserer toutes les images requis</p>' ;
      }
  } else {
    $message1 = '<p class="error">remplissez tous les champs</p>' ;
  }
}
// insertion du vehicule fin

// insertion  modele debut
if( isset($_POST['sendNewModele']) ) {
  if( !empty($_POST['modele']) ) {
    if( !empty($_FILES['logo']['name']) ) {
        // fonctions insertion du logo
        $ok = "insert" ;
        insert_modele() ;
    } else {
      $message2 = '<p class="error">ajouter image</p>' ;
    }
  } else {
    $message2 = '<p class="error">remplissez tous les champs</p>' ;
  }
}
// insertion  modele fin
?>

<section>

<div class="admin-content">
  <h2>remplir le formulaire pour ajouter un nouveau vehicule</h2>
  <form action="" method="post" enctype="multipart/form-data">
    <?= isset($message1) ? $message1 : "" ; ?>
    <!-- donnee de la table details debut -->
    <input type="number" name="km" placeholder="kilometrage">
    <input type="number" name="prix" placeholder="prix">
    <input type="number" name="edition" placeholder="edition">
    <div>
      <select name="etat">
        <option value="" disable selected>etat vehicule</option>
        <option value="1">nouveau</option>
        <option value="2">occasion</option>
      </select>
      <!-- donnee de la table details fin-->
      <!-- donnee de la table logo debut -->
      <select name="modele">
        <option value="" disable selected>modele</option>
        <option value="">bmw</option>

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
      <!-- donnee de la table logo fin -->
    </div>
      <!-- donnee de la table image debut -->
    <div class="custom-file-upload">
      <i class="fa-solid fa-circle-plus"></i>
      <input type="file" name="vehicule" id="image" class="file-upload">
      <label for="image">vehicule</label>
    </div>
      <!-- donnee de la table image fin -->
      <!-- donnee de la table image secondaire debut -->
    <div>
      <div class="custom-file-upload">
        <i class="fa-solid fa-circle-plus"></i>
        <input type="file" name="arriere" id="image" class="file-upload">
        <label for="image">arriere</label>
      </div>
      <div class="custom-file-upload">
        <i class="fa-solid fa-circle-plus"></i>
        <input type="file" name="avant" id="image" class="file-upload">
        <label for="image">avant</label>
      </div>
      <div class="custom-file-upload">
        <i class="fa-solid fa-circle-plus"></i>
        <input type="file" name="interieur" id="image" class="file-upload">
        <label for="image">interieur</label>
      </div>
      <div class="custom-file-upload">
        <i class="fa-solid fa-circle-plus"></i>
        <input type="file" name="tableau" id="image" class="file-upload">
        <label for="image">tableau de bord</label>
      </div>
    </div>
      <!-- donnee de la table image secondaire debut -->

    <input type="submit" name="sendNewCar" value="valider">

  </form>
</div>

<pre>
  <?= isset($ok) ? $ok : "rien" ; ?>
</pre>

<div class="admin-content">
  <h2>remplir le formulaire pour inserer une marque</h2>
  <form action="" method="post" enctype="multipart/form-data">
    <?= isset($message2) ? $message2 : "" ; ?>
    <div class="custom-file-upload">
      <!-- donnee de la table logo (modele) debut -->
      <i class="fa-solid fa-circle-plus"></i>
      <input type="file" name="logo" id="logo" class="file-upload">
      <label for="logo">logo de la marque</label>
    </div>
    <input type="text" name="modele" placeholder="entre un modele...">
      <!-- donnee de la table logo (modele) fin -->
    <input type="submit" name="sendNewModele" value="envoyer">
  </form>
</div>
</section>
