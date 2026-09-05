<?php
require '../app/database/cnx.php' ;
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'autoloader' . DIRECTORY_SEPARATOR . 'autoload.php' ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>details vehicule</title>
  <link rel="stylesheet" href="../public/css/style.css">
  <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.css"
    />
</head>
<body>
<?php 

      $marqueID = $_GET['marqueID'] ;

      $sql_details = "SELECT dt.km, dt.prix, dt.edition, dt.marqueID, et.etat
              FROM detail AS dt
              JOIN etat AS et ON dt.etatID = et.etatID
              WHERE dt.marqueID = :marqueID" ;

      $sql_images = "SELECT img.imageSec, img.marqueID FROM image AS img
              WHERE img.marqueID = :marqueID" ;

      $req_details = $cnx->prepare($sql_details) ;
      $req_details->execute(array(
        ":marqueID" => $marqueID
      )) ;
      $details = $req_details->fetch() ;

      $req_images = $cnx->prepare($sql_images) ;
      $req_images->execute(array(
        ":marqueID" => $marqueID
      )) ;
      $images = $req_images->fetchAll() ;
?>
  <div>

    <div class="detail-car">

<?php
if($details):
?>

      <div class="swiper mySwiper">
        <div class="swiper-wrapper">

<?php
foreach($images AS $img):
?>
  
          <div class="swiper-slide">
            <img src="../public/image/db/car/<?= $img['imageSec'] ; ?>" alt="<?= $img['imageSec'] ; ?>" >  
          </div>
      
<?php
endforeach ;
?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>

      <div class="detail_desc">
        <p><i class="fa-solid fa-gauge-simple-high"></i><?= $details['km'] ; ?>kilometre</p>
        <p><i class="fa-solid fa-hand-holding-dollar"></i><?= $details['prix'] ; ?>$</p>
        <p><i class="fa-solid fa-calendar-days"></i><?= $details['edition'] ; ?></p>
        <p><i class="fa-solid fa-gear"></i><?= $details['etat'] ; ?></p>
        <button id="buy_sub">acheter</button>
      </div>

<?php
endif ;
?>

    </div>

    <div id="buy_form" class="content-form">
      <form action="" method="post">
        <input type="text" name="" id="">
        <input type="text" name="" id="">
        <textarea name="" id=""></textarea>

        <input type="checkbox" name="" id="">
        <input type="checkbox" name="" id="">

        <input type="submit" name="" value="">
        <button id="btn_close">annuler</button>
      </form>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a6b68e8c8c.js" crossorigin="anonymous"></script>
  <script>
      var swiper = new Swiper('.mySwiper', {
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
  </script>
  <script src="../public/js/script.js"></script>
</body>
</html>