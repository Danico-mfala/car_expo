<?php
// suppression du vehicule indentation ok
require('../../../app/database/cnx.php');

header('Content-Type: application/json');

$input = file_get_contents('php://input');
$decode = json_decode($input, true);

$id = $decode['id'] ?? null;
$pathImg = "../../../public/image/db/car/" . ($decode['img'] ?? "");

try {
  if (!empty($id)) {
    if (file_exists($pathImg)) {
      unlink($pathImg);

      $sql = "DELETE FROM vehicule WHERE marqueID = :id";
      $req = $cnx->prepare($sql);
      $req->execute([":id" => $id]);

      echo json_encode([
        "success" => true,
        "message" => "Fichier supprimé"
      ]);
    } else {
      echo json_encode([
        "success" => false,
        "message" => "Fichier non supprimé " . $pathImg
      ]);
    }
  } else {
    echo json_encode([
      "success" => false,
      "message" => "ID invalide"
    ]);
  }
} catch (PDOException $e) {
  echo json_encode([
    "success" => false,
    "message" => "Erreur lors de la suppression" . $e->getMessage()
  ]);
}
