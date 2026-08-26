<?php
session_start() ; // initialisation de la session
?>
<div>
  <h2>deconnexion</h2>
  <form action="" method="post">
    <input type="submit" name="deconnexion" value="se deconnecter">
  </form>
</div>
<?php
if (isset($_POST['deconnexion'])) {
  session_destroy() ; // destruiction de la session 
  header('location:../../../index.php') ;
}
?>