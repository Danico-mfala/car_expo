<?php 
// require ('../../app/database/cnx.php') ;
?>
<section>
  <!-- bar de recherche et filtrage -->
  <div class="nav_all">
    <input type="text" placeholder="touver un vehicule" value="" >
      <select>
        <option value="" disable selected>modele</option>

<?php
$sql = "SELECT modele FROM modele" ;
$req = $cnx->prepare($sql) ;
$req->execute() ;
while($data = $req->fetch(PDO::FETCH_OBJ)) {
?>
        <option value="<?= $data->modele ; ?>"><?= $data->modele ; ?></option>

<?php } if( !isset($data) ) { ?>

        <option value="" disable selected>-- aucun modele --</option>

<?php } ?>

      </select>
  </div>  
  <!-- bar de recherche et filtrage -->

  <h2>catalogue</h2>
  <div class="catalogue">

<?php
$sql = "SELECT * FROM vehicule AS vh JOIN
        detail AS dt ON vh.marqueID = dt.marqueID" ;
$req = $cnx->prepare($sql) ;
$req->execute() ;
$vehicules = $req->fetchAll() ;
?>
<?php
foreach($vehicules as $vehicule) {
?>
    <!-- card du vehicule -->
      <div class="card-cat" id="<?= $vehicule['marqueID'] ?>">
        <img src="../../public/image/db/car/<?= $vehicule['image'] ?>" alt="<?= $vehicule['marque'] ?>">
        <p><?= $vehicule['marque'] ?><p/>
        <p><?= $vehicule['km'] ?></p>
        <p><?= $vehicule['prix'] ?></p>
        <p><?= $vehicule['date'] ?></p>
        <p><?= $vehicule['etatID'] === 1 ? "nouveau" : "occasion" ; ?></p>
        <div>
          <button class="editSVG" id="<?= $vehicule['marqueID'] ?>">
            <i class="fa-regular fa-pen-to-square"></i>
          </button>
          <button class="trashSVG" id="<?= $vehicule['marqueID'] ?>">
            <i class="fa-solid fa-trash"></i>
          </button>
        </div>
      </div> 
    <!-- card du vehicule -->
      
      <?php } ?>
    </div>
    <!-- garde fou pour la suppression -->
    <div class="overlay">
      <div class="alert-box">
        <span>Voulez-vous supprimer cet élément ?</span>
        <div class="buttons">
          <button class="btn btn-cancel">Non</button>
          <button class="btn btn-confirm">Oui</button>
        </div>
      </div>
    </div>
    <!-- garde fou pour la suppression -->
    <!-- formulaire de modification -->
    <form style="display: none;" class="form-update">
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

      <input type="button" name="modifier" value="modifier">

  </form>
    <!-- formulaire de modification -->

</section>