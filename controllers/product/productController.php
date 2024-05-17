<?php


class ProductController
{
    // attributes
    private $product;
    // constructor
    public function __construct()
    {

        $db = new Database();
        $con = $db->getConnection();
        $this->product = new Produit($con);
    }

    // return all product
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $produits = $this->product->All();
            echo json_encode($produits);
        } else {
            echo json_encode(array("message" => "Method not allowed"));
        }
    }

    // return one product by id
    public function one($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $product = $this->product->One($id);
            if ($product) {
                echo json_encode($product);
            } else {
                echo json_encode(["message" => "Product not found"]);
            }
        } else {
            echo json_encode(["message" => "Method not allowed"]);
        }
    }


    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $produit = $this->product;
        
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
        
    }
}
