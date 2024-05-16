<?php
include("models/product/produit.php");
include("config/database.php");


$con  = new Database();
$db = $con->getConnection();
$produit = new produit($db);
$produits = $produit->all();
print_r($produits);
