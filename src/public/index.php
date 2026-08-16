<?php
require '../app/database/cnx.php' ;
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'autoloader' . DIRECTORY_SEPARATOR . 'autoload.php' ;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>page accuiel</title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <!-- header -->
  <header>

    <!-- nav bar -->
    <nav>
      <div class="logo">
        <img src="./image/home/logo.avif" alt="logo">
        <span>carexpo</span>
      </div>

      <ul>
        <li><a href="#"><i class="fas fa-home"></i>accueil</a></li>
        <li><a href="#"><i class="fa-solid fa-car"></i>catalogue</a></li>
        <li><a href="#"><i class="fas fa-briefcase"></i>contact</a></li>
        <li><a href="#"><i class="fas fa-info-circle"></i>apropos</a></li>
      </ul>

      <a href="#" class="btn_admin">
        <i class="fa-regular fa-circle-user"></i>
      </a>
    </nav>
    <!-- nav bar -->

    <!-- home -->
    <div class="home">
      <div class="home_image"
        style="background:linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)) , center / cover no-repeat url('./image/home/LC.jpg') ;">

        <div class="home_description">
          <div>
            <h2>bienvenue</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, blanditiis!</p>
            <button><a href="../page/contact.php">contatez nous</a></button>
          </div>
        </div>

      </div>
    </div>
    <!-- home -->

  </header>
  <!-- header -->

  <!-- separeteur -->
  <hr>
  <!-- separeteur -->
  <!-- section logo links -->
  <div class="logo_links"> 

        <a href="index.php?hlogo=0#catalogue">
          <i class=""></i>
          <p>tous</p>
        </a>
<?php
// requete pour l'afficher des logos de marques dispo
    $sql = "SELECT modeleID, modele, logo FROM logo" ;
    $req = $cnx->prepare($sql) ;
    $req->execute() ;

    while($data = $req->fetch(PDO::FETCH_OBJ)) {
?>

        <a href="index.php?hlogo=<?= $data->modeleID ?>#catalogue">
          <img src="./image/db/logo/<?= $data->logo ?>" alt="<?= $data->modele ?>">
          <p><?= $data->modele ?></p>
        </a>

<?php
    }
?>

  </div>
  <!-- section logo links -->
  <!-- separeteur -->
  <hr>
  <!-- separeteur -->
  <!-- section catalogue -->
  <div>

    <form class="match" id="macthForm" action="" method="get">
      <input type="text" name="search" placeholder="trouver une voiture..." id="searchInput" value="<?= $_GET['search'] ?? '' ?>">
      <select name="filter" id="filterSelect">
        <option value="" disable selected>filtre</option>
        <option value="1">nouveau</option>
        <option value="2">occasion</option>
      </select>
    </form>
    <!-- separeteur -->
    <hr id="catalogue">
    <!-- separeteur -->
    <div class="catalogue">
<?php
// requete pour l'afficher de toutes les voiture dispo
    $hlogo = intval($_GET['hlogo'] ?? 0) ;
    $filter = intval($_GET['filter'] ?? 0) ;
    $search = trim($_GET['search'] ?? '') ;

    $sql = "SELECT DISTINCT vh.marqueID, vh.image, vh.marque, 
            vh.modeleID, dt.etatID, dt.marqueID FROM vehicule AS vh
            JOIN detail AS dt ON vh.marqueID = dt.marqueID WHERE 1=1" ;
    $params = array() ;

    if($hlogo > 0) {
      $sql .= " AND vh.modeleID = :hlogo" ;
      $params[':hlogo'] = $hlogo ;
    }

    if($filter > 0) {
      $sql .= " AND dt.etatID = :filter" ;
      $params[':filter'] = $filter ;
    }

    if(!empty($search)) {
      $sql .= " AND LOWER(vh.marque) LIKE :search" ;
      $params[":search"] = "%".strtolower($search)."%" ;
    }
    $req = $cnx->prepare($sql) ;
    $req->execute($params) ;
    $count = $req->rowCount() ;

    if($count > 0) {
      while($data = $req->fetch(PDO::FETCH_OBJ)) {
?>

      <div>
        <img src="./image/db/car/<?= $data->image ?>" alt="<?= $data->marque ?>">
        <p><?= $data->marque ?></p>
        <button><a href="../page/details.php?marqueID=<?= $data->marqueID ?>">details</a></button>
      </div>

<?php
    }
  }else { 
?> 

      <div class="catalogue-nothing">
        <p>aucun vehicule disponible</p>
      </div>

<?php
}
?> 

    </div>     
  </div>
  <!-- section catalogue -->
    <!-- separeteur -->
    <hr>
    <!-- separeteur -->
  <!-- section footer -->
  <?php
  loadFile('page','template','footer');
  ?>
  <!-- section footer -->

  <script src="./js/script.js"></script>
  <script src="https://kit.fontawesome.com/a6b68e8c8c.js" crossorigin="anonymous"></script>
</body>

</html>