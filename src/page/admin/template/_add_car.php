<?php
require ('../../app/database/cnx.php') ;

// insertion du vehicule debut
if (isset($_POST['sendNewCar'])) {
    if (!empty($_POST['km']) && !empty($_POST['prix']) && !empty($_POST['edition']) && !empty($_POST['etat']) && !empty($_POST['modele'])) { // verifie si les champs text ne sont pas vide
        if (!empty($_FILES['vehicule']['name'])) { // si le champs image  ne pas vide debut
            $tmpVehicule = $_FILES['vehicule']['tmp_name'];
            $destVehicule = '../../public/image/db/car/' . basename($_FILES['vehicule']['name']);
            if (move_uploaded_file($tmpVehicule, $destVehicule)) { // si le fichier est deplacer

                // requete Insertion véhicule
                $sqlVehicule = "INSERT INTO vehicule (image, marque, modeleID) VALUES (:image, :marque, :modele)";
                $reqVehicule = $cnx->prepare($sqlVehicule);
                $reqVehicule->execute([
                    ":image" => $_FILES['vehicule']['name'],
                    ":marque" => $_POST['marque'],
                    ":modele" => $_POST['modele']
                ]);
                $marqueID = $cnx->lastInsertId();

                // requte Insertion détail
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

                // requete Insertion images secondaires
                $images = ['avant', 'arriere', 'interieur', 'tableau'];
                foreach ($images as $img) {
                    if (isset($_FILES[$img]) && $_FILES[$img]['error'] === 0) { // si les images sont uploder
                        $tmp = $_FILES[$img]['tmp_name'];
                        $dest = '../../public/image/db/car/' . basename($_FILES[$img]['name']);
                        if (move_uploaded_file($tmp, $dest)) { // si les fichier sont deplacer debut
                            $sqlImage = "INSERT INTO image (imageSec, marqueID) VALUES (:imageSec, :marqueID)";
                            $reqImage = $cnx->prepare($sqlImage);
                            $reqImage->execute([
                                ":imageSec" => $_FILES[$img]['name'],
                                ":marqueID" => $marqueID
                            ]);
                        } else {
                        $message1 = '<p class="error">echec du deplacement des images secondaire</p>'; 
                       } // si les fichier sont deplacer fin
                    } 
                }

                $message1 = '<p class="success">Véhicule ajouté avec succee</p>';
            } else {
                $message1 = '<p class="error">echec du déplacement de l image principal</p>';
            }
        } else {
            $message1 = '<p class="error">Veuillez insérer toutes les images requises</p>';
        }
    } else { // verifie si les champs text ne sont pas vide suite
        $message1 = '<p class="error">Remplissez tous les champs</p>';
    } // verifie si les champs text ne sont pas vide fin
}

// insertion du vehicule fin

// insertion  modele debut
if( isset($_POST['sendNewModele']) ) {
  if( !empty($_POST['modele']) ) {
    if( !empty($_FILES['logo']['name']) ) {
        // fonctions insertion du logo
        // insert_modele() ;

      $dossierTempo = $_FILES['logo']['tmp_name'] ;
      $dossierSite = '../../public/image/db/logo/' . $_FILES['logo']['name'] ;

      if(move_uploaded_file($dossierTempo, $dossierSite)) {

        $sql = "INSERT INTO modele (modele, logo)
              VALUES (:modele, :logo)" ;
        $req = $cnx->prepare($sql) ;
        $req->execute(array(
        ':modele' => $_POST['modele'],
        ':logo' => $_FILES['logo']['name']
        )) ;
        $retour = $req->rowCount() ;

          if($retour > 0) {
            $message2 = '<p class="success">modele inserer</p>' ;
          } else {
            $message2 = '<p class="error">insertion echouee</p>' ;
          }

      } else {
        $message2 = '<p class="error">echec du deplacement du fichier</p>' ;
      }

    } else {
      $message2 = '<p class="error">insere image</p>' ;
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
