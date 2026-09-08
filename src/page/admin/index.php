<?php
session_start() ;
if( !isset($_SESSION['admin']) ){
  header('location:../index.php') ;
  exit() ;
} else {
  require ('./function/_func_display.php') ;

  $admin_name = isset($_SESSION['admin']) ? $_SESSION['admin'] : "" ;
  $query_get = $_GET['page'] ;
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>admin <?= $admin_name ; ?></title>
  <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
  <?php require('_nav.php') ; ?>
  <article>
    <?php switchPage($query_get) ;?>
  </article>
  <script src="https://kit.fontawesome.com/a6b68e8c8c.js" crossorigin="anonymous"></script>
  <script src="../../public/js/admin-delete-item.js"></script>
  <script src="../../public/js/admin-script.js"></script>
</body>
</html>
<?php } ?>