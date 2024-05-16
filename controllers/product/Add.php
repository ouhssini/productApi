<?php
include '../../config/access.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include configuration and data access files
    include '../../config/Database.php';
    include '../../models/product/Produit.php';


    // Instantiate the database

    $db = new Database();
    $con = $db->getConnection();
    // Instantiate products
    $produit = new Produit($con);

    $contentType = $_SERVER["CONTENT_TYPE"] ?? '';

    if (strpos($contentType, 'application/json') !== false) {
        $data = json_decode(file_get_contents("php://input"));
    } elseif (strpos($contentType, 'application/x-www-form-urlencoded') !== false) {
        $data = (object) $_POST; // Convert $_POST array to object
    }

    //echo $data;
    // Data validation
    if (!empty($data->nom) && !empty($data->description) && !empty($data->prix) && !empty($data->categories_id)) {
        // Data received
        // Hydrate our object
        $produit->nom = $data->nom;
        $produit->description = $data->description;
        $produit->prix = $data->prix;
        $produit->categories_id = $data->categories_id;
        $produit->created_at = $data->created_at;

        if ($produit->Add()) {
            http_response_code(200);
            echo json_encode(["message" => "The addition was successful", "infoProduit" => $produit]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "The addition was not successful"]);
        }
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed"]);
}
