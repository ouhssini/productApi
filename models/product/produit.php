<?php

class Produit
{
    // Attribute to handle the database operations
    private $table = "produits";
    private $con;

    // Product attributes (columns in the database)
    public $id;
    public $nom;
    public $description;
    public $prix;
    public $categories_id;
    public $created_at;
    public $updated_at;

    // Constructor to initialize the database connection
    public function __construct($db)
    {
        $this->con = $db;
    }

    // Method to retrieve all products from the database
    public function all(){
        $query = "SELECT * FROM " . $this->table;
        try {
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            return "Error while retrieving products: " . $e->getMessage();
        }
    }

}
