<?php
require('../../../app/database/cnx.php');

header('Content-Type: application/json');

try {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = (int) $_GET['id'];

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
            "message" => "ID invalide"
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Erreur lors de la suppression"
    ]);
}