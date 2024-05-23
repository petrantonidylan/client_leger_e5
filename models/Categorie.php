<?php

// On créé un modèle Categorie qui va servir à manipuler notre table Categorie dans la base de donnée
// Il contient la logique métier
class Categorie
{

    private $table="Categorie";
    private $connexion;

    // On créé autant de propriété qu'il y en a dans la table Categorie de la base
    private $categorie_id;
    private $categorie_nom;

    public function __construct($connexion)
    {
        $this -> connexion = $connexion;
    }

    // LES GETTERS pour récupérer la valeur des propriétés :
    public function getCategorieId()
    {
        return $this -> categorie_id;
    }

    public function getCategorieNom()
    {
        return $this -> categorie_nom;
    }

    // LES SETTERS pour attribuer une valeur à chaque propriété:
    
    public function setCategorieId($id)
    {
        $this -> categorie_id = $id;
    }

    public function setCategorieNom($nom)
    {
        $this -> categorie_nom = $nom;
    }

    //Mise en place du CRUD (create, read, update, delete)

    // RECUPERE TOUTES LES PROPRIETES D'UNE TABLE :
    public function getAll()
    {
        $query = $this -> connexion -> prepare("SELECT * FROM ".$this -> table);
        $query -> execute();
        $result = $query -> fetchAll();
        $this -> connexion = null;
        return $result;
    }

    // INSERT D'UNE CATEGORIE EN BDD
    public function insert(){
        try{
            $nom = $this -> categorie_nom;
            $query = $this->connexion->prepare("INSERT INTO " . $this->table . " (categorie_nom) VALUES (:nom)");
            $query->bindParam(':nom', $nom);
            $query->execute();
            $this -> connexion = null;
            return "";
        }catch(Exception $e)
        {
            // echo $e;
            header('Location: index.php?controller=Categorie');
        }
    }

    // SUPPRIMER UNE CATEGORIE
    public function delete()
    {
        try{
                $query = $this -> connexion -> prepare("DELETE FROM ".$this->table." WHERE categorie_id = :id");
                $query -> execute(array("id"=>$this->categorie_id));
                $this -> connexion = null;
        }catch(Error $e)
        {
            echo "Impossible de supprimer une catégorie liée à au moins un film.";
        }
        return "";
    }

    // RECUPERE LES PROPRIETES d'une catégorie en fonction de son ID :
    public function getById($id)
    {
        $query = $this -> connexion -> prepare("SELECT * FROM ".$this -> table." WHERE categorie_id = :id");
        $query -> execute(array("id" => $id));
        $result = $query -> fetchObject();
        $this -> connexion = null;
        return $result;
    }

    // modifier une catégorie
    public function update()
    {
        try{
        $id = $this->categorie_id;
        $nom = $this->categorie_nom;

        // Requête SQL avec les noms de colonnes corrects
        $query = $this->connexion->prepare("
            UPDATE Categorie
            SET
            categorie_nom = :nom
            WHERE
            categorie_id = :categorie_id
        ");

        // Liaison des valeurs aux paramètres dans la requête
        $query->bindValue(':categorie_id', $id, PDO::PARAM_INT);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->execute();

        $this -> connexion = null;
        return "";
        }catch(Exception $e)
        {
            // echo $e;
            header('Location: index.php?controller=Categorie');
        }
    }
}