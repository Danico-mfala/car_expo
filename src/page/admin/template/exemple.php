<?php
// insertion du vehicule debut
if( isset($_POST['sendNewCar']) ) {
  if( !empty($_POST['km']) && !empty($_POST['prix']) && !empty($_POST['edition']) && !empty($_POST['etat']) && !empty($_POST['modele']) ) { // tous le champs rempli
      if( !empty($_FILES['vehicule']['name']) && !empty($_FILES['avant']['name']) && !empty($_FILES['arriere']['name']) && !empty($_FILES['interieur']['name']) && !empty($_FILES['tableau']['name']) ) { /* toutes les image inserer */
        // fonctions insertion du vehicules
        // insertion vehicule
          $sqlVehicule = "INSERT INTO vehicule (image, marque, modeleID) 
                VALUES (:image, :marque, :modele)";
          $reqVehicule = $cnx->prepare($sqlVehicule);
          $reqVehicule->execute([
            ":image" => $_FILES['vehicule']['name'],
            ":marque" => $_POST['marque'],
            ":modele" => $_POST['modele']
          ]);
          $marqueID = $cnx->lastInsertId(); // récupère l'ID du véhicule inséré
        // insertion vehicule
        // insertion detail
          $sqlDetail = "INSERT INTO detail (edition, etatID, km, marqueID, prix)
              VALUES (:edition, :etat, :km, :marqueID, :prix)";
          $reqDetail = $cnx->prepare($sqlDetail);
          $reqDetail->execute([
            ":edition" => $_POST['edition'],
            ":etat" => $_POST['etat'],
            ":km" => $_POST['km'],
            ":marqueID" => $marqueID,
            ":prix" => $_POST['prix']
          ]);
        // insertion detail
        // insertion image
        $images = ['avant', 'arriere', 'interieur', 'tableau'];
        foreach ($images as $img) {
          if (isset($_FILES[$img]) && $_FILES[$img]['error'] === 0) {
            $tmp = $_FILES[$img]['tmp_name'];
            $dest = '../../public/image/db/car/' . basename($_FILES[$img]['name']);
            if (move_uploaded_file($tmp, $dest)) {
              $sqlImage = "INSERT INTO image (imageSec, marqueID)
                          VALUES (:imageSec, :marqueID)";
              $reqImage = $cnx->prepare($sqlImage);
              $reqImage->execute([
                ":imageSec" => $_FILES[$img]['name'],
                ":marqueID" => $marqueID
              ]);
            }
          }
        }

        } else {
        $message1 = '<p class="error">inserer toutes les images requis</p>' ;
      }
  } else {
    $message1 = '<p class="error">remplissez tous les champs</p>' ;
  }
}
// insertion du vehicule fin
?>

<div class="admin-content">
  <h2>remplir le formulaire pour ajouter un nouveau vehicule</h2>
  <form action="" method="post" enctype="multipart/form-data">
    <?= isset($message1) ? $message1 : "" ; ?>
    <!-- donnee de la table vehicule debut -->
    <input type="text" name="marque" placeholder="marque du vehicule">
    <!-- donnee de la table vehicule suite -->
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
$sql = "SELECT modeleID, modele FROM modele" ;
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
      <!-- donnee de la table vehicule suite -->
    <div class="custom-file-upload">
      <i class="fa-solid fa-circle-plus"></i>
      <input type="file" name="vehicule" id="image" class="file-upload">
      <label for="image">vehicule</label>
    </div>
      <!-- donnee de la table vehicule fin -->
      <!-- donnee de la table image debut -->
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
      <!-- donnee de la table image fin -->

    <input type="submit" name="sendNewCar" value="valider">

  </form>
</div>