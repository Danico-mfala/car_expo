<?php
require 'app/database/cnx.php' ;
require_once 'app/autoloader/autoload.php' ;
loadFile('page','template','head');
?>

<body>
  <!-- header -->
  <header>
    <!-- nav bar -->
    <nav class="z-3">
      <div class="nav_logo">
        <img src="public/image/home/logo.avif" alt="logo">
        <span>carexpo</span>
      </div>
      <ul>
        <li><a href="#"><i class="fas fa-home"></i>accueil</a></li>
        <li><a href="#"><i class="fa-solid fa-car"></i>catalogue</a></li>
        <li><a href="page/contact.php"><i class="fas fa-briefcase"></i>contact</a></li>
        <li><a href="#"><i class="fas fa-info-circle"></i>apropos</a></li>
      </ul>
      <a href="./page/index.php" class="">
        <i class="fa-regular fa-circle-user"></i>
      </a>
    </nav>
    <!-- nav bar -->
    <!-- home -->
      <div class="home">
        <div class="home_font"
          style="background:linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)) , center / cover no-repeat url('public/image/home/shutts.jpg') ;">
          <div>
            <div class="home_center">
              <h1>bienvenue</h1>
              <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, blanditiis!</h2>
              <button><a href="page/contact.php">contatez nous</a></button>
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
  <div class="links_content">
    <h2>marque disponibles</h2>
    <div>
      <a href="index.php?hlogo=0#catalogue">
        <i></i>
        <p class="">tous</p>
      </a>
<?php
// requete pour l'afficher des logos de marques dispo
    $sql = "SELECT modeleID, modele, logo FROM modele" ;
    $req = $cnx->prepare($sql) ;
    $req->execute() ;

    while($data = $req->fetch(PDO::FETCH_OBJ)) {
?>
      <a href="index.php?hlogo=<?= $data->modeleID ?>#catalogue">
        <img src="public/image/db/logo/<?= $data->logo ?>" alt="<?= $data->modele ?>">
        <p>
          <?= $data->modele ?>
        </p>
      </a>
<?php
    }
?>
    </div>
  </div>
  <!-- section logo links -->
  <!-- separeteur -->
  <hr>
  <!-- separeteur -->
  <!-- section match car -->
  <div class="match_car">
    <!-- From Uiverse.io by LightAndy1 --> 
    <div class="search">
      <i class="fa-solid fa-magnifying-glass" id="search-icon"></i>
      <input
        id="query"
        class="input"
        type="search"
        placeholder="Search..."
        name="searchbar"
      />
    </div>
    <div class="filter">
      <select name="" id="">
        <option selected>etat du vehicule</option>
        <option value="1">nouveau</option>
        <option value="2">occasion</option>
      </select>
    </div>
  </div>
  <!-- section match car -->
  <!-- section catalogue -->
  <div>
    <!-- separeteur -->
    <hr id="catalogue">
    <!-- separeteur -->
<?php
      $sql = "SELECT * FROM vehicule" ;
      $req = $cnx->prepare($sql) ;
      // $req->execute($params) ;
      $req->execute() ;
      $count = $req->rowCount() ;
      
  if($count > 0) {
  while($data = $req->fetch(PDO::FETCH_OBJ)) {
?>
    <div class="px-4 d-flex flex-wrap gap-4 justify-content-center">
      <div class="card row mx-2" style="width: 18rem">
        <img src="public/image/db/car/<?= $data->image ?>" alt="<?= $data->marque ?>" class="card-img-top">
        <div class="px-4 py-2">
          <h3 class="card-title">
            <?= $data->marque ?>
          </h3>
          <p class="card-text text-primary-emphasis">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          <a href="page/details.php?marqueID=<?= $data->marqueID ?>" class="btn btn-primary pointer">details</a>
        </div>
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

  <script src="public/js/script.js"></script>
</body>

</html>