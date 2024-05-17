<?php
include './config/headers.php';
include_once './config/database.php';
include './controllers/product/productController.php';
include './models/product/produit.php';
// système de routage = déclaration des chemins vers les ressources





if (isset($_GET['folder']) && !empty($_GET['folder']) && isset($_GET["action"]) && !empty($_GET["action"])) {
    $prod = new ProductController();
    $act = $_GET["action"];
    $fold = $_GET['folder'];
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    switch ($fold) {
        case 'products':
            switch ($act) {
                case 'all':
                    $prod->index();
                    break;
                case 'product':
                    $prod->one($id);
                    break;
                case 'add':
                    $prod->add();
                    break;
            }
            break;
        case 'categories':
            switch ($act) {
                case 'all':
                    echo 'all category';
                    break;
                case 'add':
                    echo 'add category';
                    break;
            }
            break;
    }
}
