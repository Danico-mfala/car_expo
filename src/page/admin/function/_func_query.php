<?php
// require ('../../app/database/cnx.php') ;

// function insertion  modele debut 
function insert_modele() {

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
          return $message2 = '<p class="success">modele inserer</p>' ;
        } else {
          return $message2 = '<p class="error">insertion echouee</p>' ;
        }

    }
}
// function insertion  modele fin

function  insert_vehicule() {
  $modele = $_POST['modele'] ;
  $etat = $_POST['etat'] ;
  $dossierTempovh = $_FILES['vehicule']['tmp_name'] ;
  $dossierSitevh =  '../../public/image/db/car/' . basename($_FILES['vehicule']['name']);
  if(move_uploaded_file($dossierTempovh, $dossierSitevh)) {

    $sql = "INSERT INTO vehicule AS vh 
    (image, marque, modeleID, km, prix, edition, etatID)
    JOIN details AS dt ON vh.marqueID = dt.marqueID
    VALUES (:image, :marque, :modele, :km, :prix, :edition, :etat)" ;
    $req = $cnx->prepare($sql) ;
    $req->execute(array(
      ":image" => $_FILES['vehicule']['name'],
      ":marque" => $_POST['marque'],
      ":modele" => $modele,
      ":km" => $_POST['km'],
      ":prix" => $_POST['prix'],
      ":edtion" => $_POST['edition'],
      ":etat" => $etat
    )) ;
    
  }

  $images = ['avant', 'arriere', 'interieur', 'tableau'];
  foreach ($images as $img) {
    if(isset($_FILES[$img]) && $_FILES[$img]['error'] === 0) {

        $dossierTempo = $_FILES[$img]['tmp_name'] ;
        $dossierSite = '../../public/image/db/car/' . basename($_FILES[$img]['name']) ;
        if(move_uploaded_file($dossierTempo, $dossierSite)) {
    
            $sql_img = "INSERT INTO image (imageSec, modeleID) 
                    VALUES (:imageSec, :modele)" ;
            $req_img = $cnx->prepare($sql_img) ;
            $req_img->execute(array(
              ":imageSec" => $_FILES[$img]['name'],
              ":modele" => $modele
            )) ;
            $retour = $req->rowCount() ;
            if($retour > 0) {
              $message1 = '<p class="success">vehicule inserer</p>' ;
            } else {
              $message1 = '<p class="error">insertion echouee</p>' ;
            }
        }else {
        $message1 = '<p class="error">echec du deplacement du fichier</p>' ;
        } 
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