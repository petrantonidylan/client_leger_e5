<?php

// On créé un modèle Acteur qui va servir à manipuler notre table Acteur dans la base de donnée
// Il contient la logique métier
class Acteur
{

    private $table="Acteur";
    private $connexion;

    // On créé autant de propriété qu'il y en a dans la table Acteur de la base
    private $acteur_id;
    private $acteur_nom;
    private $acteur_prenom;

    public function __construct($connexion)
    {
        $this -> connexion = $connexion;
    }

    // LES GETTERS pour récupérer la valeur des propriétés :
    public function getActeurId()
    {
        return $this -> acteur_id;
    }

    public function getActeurNom()
    {
        return $this -> acteur_nom;
    }

    public function getActeurPrenom()
    {
        return $this -> acteur_prenom;
    }

    // LES SETTERS pour attribuer une valeur à chaque propriété:
    
    public function setActeurId($id)
    {
        $this -> acteur_id = $id;
    }

    public function setActeurNom($nom)
    {
        $this -> acteur_nom = $nom;
    }

    public function setActeurPrenom($prenom)
    {
        $this -> acteur_prenom = $prenom;
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

    // INSERT D'UNE Acteur EN BDD
    public function insert(){
        try{
            $nom = $this -> acteur_nom;
            $prenom = $this -> acteur_prenom;
            $query = $this->connexion->prepare("INSERT INTO " . $this->table . " (acteur_nom, acteur_prenom) VALUES (:nom, :prenom)");
            $query->bindParam(':nom', $nom);
            $query->bindParam(':prenom', $prenom);
            $query->execute();
            $this -> connexion = null;
            return "";
        }catch(Exception $e)
        {
            // echo $e;
            header('Location: index.php?controller=Acteur');
        }
    }

    // SUPPRIMER UNE Acteur
    public function delete()
    {
        $query = $this -> connexion -> prepare("DELETE FROM ".$this->table." WHERE acteur_id = :id");
        $query -> execute(array("id"=>$this->acteur_id));
        $this -> connexion = null;
        return "";
    }

    // RECUPERE LES PROPRIETES d'une catégorie en fonction de son ID :
    public function getById($id)
    {
        $query = $this -> connexion -> prepare("SELECT * FROM ".$this -> table." WHERE acteur_id = :id");
        $query -> execute(array("id" => $id));
        $result = $query -> fetchObject();
        $this -> connexion = null;
        return $result;
    }

    // modifier une catégorie
    public function update()
    {
        try{
        $id = $this->acteur_id;
        $nom = $this->acteur_nom;
        $prenom = $this->acteur_prenom;

        // Requête SQL avec les noms de colonnes corrects
        $query = $this->connexion->prepare("
            UPDATE Acteur
            SET
            acteur_nom = :nom,
            acteur_prenom = :prenom
            WHERE
            acteur_id = :acteur_id
        ");

        // Liaison des valeurs aux paramètres dans la requête
        $query->bindValue(':acteur_id', $id, PDO::PARAM_INT);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->execute();

        $this -> connexion = null;
        return "";
        }catch(Exception $e)
        {
            // echo $e;
            header('Location: index.php?controller=Acteur');
        }
    }
}