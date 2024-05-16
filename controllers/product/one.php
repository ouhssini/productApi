<?php

include '../../config/access.php';




if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    include '../../config/Database.php';
    include '../../models/product/Produit.php';
    $id = $_GET['id'];

    $db = new Database();
    $con = $db->getConnection();
    $produit = new Produit($con);
    $produits = $produit->One($id);
    if(count($produits) > 0){
      echo json_encode($produits);
    }else{
      echo json_encode(array("message" => "Product not found"));
    }
   
  } else {
    echo json_encode(array("message" => "Id is required"));
  }
} else {
  echo json_encode(array("message" => "Method not allowed"));
}
