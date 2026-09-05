<?php 
require ('../../app/database/cnx.php') ;

?>
<section>

  <div class="nav_all">
    <input type="text" name="search">
    <select name="" id="">
      <option value="">
        <!-- option de toutes le vehicule -->
      </option>
    </select>
  </div>  

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
      <div class="card-cat">
        <img src="../../public/image/db/car/<?= $vehicule['image'] ?>" alt="<?= $vehicule['marque'] ?>">
        <p><?= $vehicule['marque'] ?><p/>
        <p><?= $vehicule['km'] ?></p>
        <p><?= $vehicule['prix'] ?></p>
        <p><?= $vehicule['date'] ?></p>
        <p><?= $vehicule['etatID'] === 1 ? "nouveau" : "occasion" ; ?></p>
      </div> 

<?php } ?>
  </div>
</section>