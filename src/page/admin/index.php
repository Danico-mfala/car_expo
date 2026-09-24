<?php 
session_start() ;
if( !isset($_SESSION['admin']) ){
    header('location:../index.php') ;
  } else {
    require ('./function/_func_display.php') ;

    $admin_name = isset($_SESSION['admin']) ? $_SESSION['admin'] : "" ;
    $query_get = $_GET['page'] ;
    require_once('../../app/autoloader/autoload.php') ;
    loadFile('page','template','head');
?>
<body>
  <?php require('_nav.php') ; ?>
  <article>
    <?php switchPage($query_get) ;?>
  </article>
  <script src="https://kit.fontawesome.com/a6b68e8c8c.js" crossorigin="anonymous"></script>
  <script src="../../public/js/admin-script.js"></script>
</body>
</html>
<?php } ?>