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
    public function All(){
        $query = "SELECT * FROM " . $this->table;
        try {
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            throw new Exception("Error while retrieving products: " . $e->getMessage());
        }
    }


    
    public function One($id){
        $query = "SELECT * FROM " . $this->table . " WHERE id=:id";
        try {
            $stmt = $this->con->prepare($query);
            $stmt->execute(["id" => $id]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            throw new Exception("Error while retrieving products: " . $e->getMessage());
        }
    }

    public function Add(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO " . $this->table . " SET nom=:nom, prix=:prix, description=:description, categories_id=:categories_id, created_at=:created_at";

        // Préparation de la requête
        $query = $this->con->prepare($sql);

        // Protection contre les injections
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->prix=htmlspecialchars(strip_tags($this->prix));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->categories_id=htmlspecialchars(strip_tags($this->categories_id));
        $this->created_at=htmlspecialchars(strip_tags($this->created_at));

        // Ajout des données protégées
        $query->bindParam(":nom", $this->nom);
        $query->bindParam(":prix", $this->prix);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":categories_id", $this->categories_id);
        $query->bindParam(":created_at", $this->created_at);

        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }



}
