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
        <img src="./image/logo.avif" alt="logo">
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
        style="background:linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)) , center / cover no-repeat url('./image/LC.jpg') ;">

        <div class="home_description">
          <div>
            <h2>bienvenue</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, blanditiis!</p>
            <button><a href="">contatez nous</a></button>
          </div>
        </div>

      </div>
    </div>
    <!-- home -->

  </header>
  <!-- header -->

  <!-- section logo links -->
  <div>    
<?php
// requete pour l'afficher des logos de marques dispo
    $sql = "SELECT modele, logo FROM logo" ;
    $req = $cnx->prepare($sql) ;
    $req->execute() ;

    while($data = $req->fetch(PDO::FETCH_OBJ)) {
?>

        <div class="logo_links">
          <img src="./image/db/logo/<?= $data->logo ?>" alt="<?= $data->modele ?>">
          <p><a href=""><?= $data->modele ?></a></p>
        </div>

<?php
    }
?>  
  </div>
  <!-- section logo links -->

  <!-- section catalogue -->
  <div class="catalogue">

    <div>
      <input type="text" name="search" placeholer="trouver une voiture">
      <select>
        <option value="nouveau">nouveau</option>
        <option value="occasion">occasion</option>
      </select>
    </div>
    
<?php
// requete pour l'afficher de toutes les voiture dispo
    $sql = "SELECT image, marque FROM vehicule" ;
    $req = $cnx->prepare($sql) ;
    $req->execute() ;

    while($data = $req->fetch(PDO::FETCH_OBJ)) {
?>

    <div>
      <img src="./image/db/logo/<?= $data->image ?>" alt="<?= $data->marque ?>">
      <p><a href=""><?= $data->marque ?></a></p>
    </div>

<?php
    }
?>      
  </div>
  <!-- section catalogue -->

  <!-- section footer -->
  <?php
  loadFile('page','template','footer');
  ?>
  <!-- section footer -->


  <script src="https://kit.fontawesome.com/a6b68e8c8c.js" crossorigin="anonymous"></script>
</body>

</html>