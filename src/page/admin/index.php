<!-- page admin pour l'insertion des donnees test dans la base de donnee -->
<?php 
session_start() ;
if( isset($_SESSION['admin']) && isset($_SESSION['pass']) ){
  $admin_name = $_SESSION['admin'] ;
  } else { 
    header('location:../index.php') ;
  }
  require '../../app/database/cnx.php' ;
  // require '../../app/autoloader/autoload.php' ;
  require './function/_func_display.php' ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>admin</title>
  <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
  
  <?php include('_nav.php') ; ?>

  <article>
    <?php 
    $query_get = $_GET['page'] ;
    switchPage($query_get) ;
    ?>
  </article>
  
  <script src="https://kit.fontawesome.com/a6b68e8c8c.js" crossorigin="anonymous"></script>
</body>
</html>