<?php

include '../../config/access.php';




if ($_SERVER['REQUEST_METHOD'] == "GET") {

  include '../../config/Database.php';
  include '../../models/product/Produit.php';


  $db = new Database();
  $con = $db->getConnection();
  $produit = new Produit($con);
  $produits = $produit->All();
  echo json_encode($produits);
} else {
  echo json_encode(array("message" => "Method not allowed"));
}
