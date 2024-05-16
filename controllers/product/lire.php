<?php

//  Headers to allow connection from any origin and to return JSON data with accepted methodes
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');




if($_SERVER['REQUEST_METHOD'] == "GET"){
    include("../models/product/produit.php");
    include("../config/database.php");
    $db = new Database();
    $con = $db->getConnection();
    $produit = new Produit($con);
    $produits = $produit->all();
    echo json_encode($produits);
}

