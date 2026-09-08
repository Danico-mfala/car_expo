<?php
/*require('../../app/database/cnx.php') ;
if(isset($_POST['id'])) {
  $id =  (int) $_POST['id'] ;
  $sql = "DELETE FROM vehicule WHERE modeleID = :id" ;
  $req = $cnx->prepare($sql) ;
  $req->execute(array(
    ":id" => $id
  )) ;
  $retour = $req->rowCount() ;
  // $req->bindParam(":id", $id, PDO::PARAM_INT) ;

  if($retour > 0) {
    echo "success" ;
  }else{
    echo "echec" ;
  }
}*/