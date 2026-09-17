<?php
require ('../../../app/database/cnx.php') ;

header('Content-Type: application/json');

$input = file_get_contents('php://input') ;

$decode = json_decode($input, true);

$etat = $decode['etat'] ?? "" ;
$edition = $decode['edition'] ?? "" ;
$km = $decode['km'] ?? "" ;
$id = $decode['id'] ?? "" ;
$marque = $decode['marque'] ?? "" ;
$modeleID = $decode['modele'] ?? "" ;
$prix = $decode['prix'] ?? "" ;

try {
    if (!empty($id) && !empty($marque) &&
        !empty($km) && !empty($edition) &&
        !empty($etat) && !empty($modeleID)) {

        $sql = "UPDATE vehicule SET  marque = :marque,
                modeleID = :modeleID WHERE marqueID = :id";
        $req = $cnx->prepare($sql);
        $req->execute([
            ":id" => $id,
            ":marque" => $marque,
            ":modeleID" => $modeleID
        ]);
        $sql = "UPDATE detail SET etatID = :etat, edition
                = :edition, km = :km, prix = :prix WHERE marqueID = :id" ;
        $req = $cnx->prepare($sql);
        $req->execute([
            ":id" => $id,
            ":etat" => $etat,
            ":edition" => $edition,
            ":km" => $km,
            ":prix" => $prix
        ]);
        echo json_encode([
            "success" => true,
            "message" => "Fichier modifier"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "fichier non modifier"
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Erreur lors de la modifaction" . $e->getMessage()
    ]);
}
