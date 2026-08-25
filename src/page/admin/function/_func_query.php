<?php

function insert_logo() {
  $dossierTempo = $_FILES['logo']['tmp_name'] ;
    $dossierSite = '../../public/image/db/logo/' . $_FILES['logo']['name'] ;
    
    $deplacer = move_uploaded_file($dossierTempo, $dossierSite) ; 
    if($deplacer) {

      $sql = "INSERT INTO logo (modele, logo)
            VALUES (:modele, :logo)" ;
      $req = $cnx->prepare($sql) ;
      $req->execute(array(
      ':modele' => $_POST['modele'],
      ':logo' => $_FILES['logo']['name']
      )) ;
      $retour = $req->rowCount() ;

        if($retour > 0) {
          $message1 = '<p class="success">modele inserer</p>' ;
        } else {
          $message1 = '<p class="error">insertion echouee</p>' ;
        }
    }
}

function  insert_vehicule() {
  $dossierTempo = $_FILES['vehicule']['tmp_name'] ;
    $dossierSite = '../../public/image/db/car/' . $_FILES['vehicule']['name'] ;
    
    $deplacer = move_uploaded_file($dossierTempo, $dossierSite) ; 
    if($deplacer) {

      $sql = "INSERT INTO vehicule (image, marque, modeleID)
              VALUES (:image, :marque, :modeleID)" ;
      $req = $cnx->prepare($sql) ;
      $req->execute(array(
      ':image' => $_FILES['vehicule']['name'],
      ':marque' => $_POST['marque'],
      ':modeleID' => $_POST['modeleID'],
      )) ;
      $retour = $req->rowCount() ;

        if($retour > 0) {
          $message2 = '<p class="success">vehicule inserer</p>' ;
        } else {
          $message2 = '<p class="error">insertion echouee</p>' ;
        }
    }
}

function insert_img_sec() {
  $dossierTempo = $_FILES['imageSec']['tmp_name'] ;
    $dossierSite = '../../public/image/db/car/' . $_FILES['imageSec']['name'] ;
    
    $deplacer = move_uploaded_file($dossierTempo, $dossierSite) ; 
    if($deplacer) {

      $sql = "INSERT INTO image (imageSec, marqueID)
              VALUES (:imageSec, :marqueID)" ;
      $req = $cnx->prepare($sql) ;
      $req->execute(array(
      ':imageSec' => $_FILES['imageSec']['name'],
      ':marqueID' => $_POST['marqueID'],
      )) ;
      $retour = $req->rowCount() ;

        if($retour > 0) {
          $message3 = '<p class="success">image inserer</p>' ;
        } else {
          $message3 = '<p class="error">insertion echouee</p>' ;
        }
    }

}