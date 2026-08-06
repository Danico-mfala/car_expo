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
</head>
<body>
<?php 
  $sql = "SELECT img.imageSec, dt.km, dt.prix, dt.date, et.etat 
          FROM image AS img
          JOIN detail AS dt
          ON img.marqueID = dt.marqueID 
          JOIN etat AS et
          ON dt.etatID = et.etatID
          WHERE img.marqueID = :marqueID" ;
  $req = $cnx->prepare($sql) ;
  $req->execute(array(
    ":marqueID" => $_GET['marqueID']
  )) ;
  while($data = $req->fetch(PDO::FETCH_OBJ)) {
?>

  <img class="teempo" src="../public/image/db/car/<?= $data->imageSec ?>" alt="<?= 'image' ; ?>" >
  <p><?= $data->km ?> kilometre</p>
  <p><?= $data->prix ?>$</p>
  <p><?= $data->date ?></p>
  <p><?= $data->etat ?></p>

<?php
  }  
?>

</body>
</html>