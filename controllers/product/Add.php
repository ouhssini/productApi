<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,GET");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On inclut les fichiers de configuration et d'accès aux données
    include '../../config/Database.php';
    include '../../models/product/Produit.php';
  

    // On instancie la base de données
  
    $db = new Database();
    $con = $db->getConnection();
    // On instancie les produits
    $produit = new Produit($con);

    // On récupère les informations envoyées
    $data = json_decode(file_get_contents("php://input"));
    
    //echo $data;
    // validation des données
    if(!empty($data->nom) && !empty($data->description) && !empty($data->prix) && !empty($data->categories_id)){
        // Ici on a reçu les données
        // On hydrate notre objet
        $produit->nom = $data->nom;
        $produit->description = $data->description;
        $produit->prix = $data->prix;
        $produit->categories_id = $data->categories_id;
        $produit->created_at = $data->created_at;

        if($produit->Add()){
            http_response_code(200);
            echo json_encode(["message" => "L'ajout a été effectué","infoProduit"=>$produit]);
        }else{
            http_response_code(503);
            echo json_encode(["message" => "L'ajout n'a pas été effectué"]);         
        }
    }
}else{
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}