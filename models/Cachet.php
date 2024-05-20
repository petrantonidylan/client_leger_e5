<?php

// On créé un modèle Cachet qui va servir à manipuler notre table Cachet dans la base de donnée
// Il contient la logique métier
class Cachet
{

    private $table="Jouer";
    private $connexion;

    // On créé autant de propriété qu'il y en a dans la table Cachet de la base
    private $film_id;
    private $acteur_id;
    private $cachet_tournage;

    public function __construct($connexion)
    {
        $this -> connexion = $connexion;
    }

    // LES GETTERS pour récupérer la valeur des propriétés :
    public function getCachetTournage()
    {
        return $this -> cachet_tournage;
    }

    public function getFilmId()
    {
        return $this -> film_id;
    }

    public function getActeurId()
    {
        return $this -> acteur_id;
    }

    // LES SETTERS pour attribuer une valeur à chaque propriété:
    
    public function setCachetTournage($cachet_tournage)
    {
        $this -> cachet_tournage = $cachet_tournage;
    }

    public function setFilmId($id)
    {
        $this -> film_id = $id;
    }

    public function setActeurId($id)
    {
        $this -> acteur_id = $id;
    }

    //Mise en place du CRUD (create, read, update, delete)

    // RECUPERE TOUTES LES PROPRIETES D'UNE TABLE :
    public function getAll()
    {
        $query = $this -> connexion -> prepare("SELECT Jouer.acteur_id, Jouer.film_id, cachet_tournage, film_titre, acteur_nom, acteur_prenom FROM ".$this -> table.", Film, Acteur WHERE Jouer.acteur_id = Acteur.acteur_id AND Jouer.film_id = Film.film_id");
        $query -> execute();
        $result = $query -> fetchAll();
        $this -> connexion = null;
        return $result;
    }

    // INSERT D'UNE Cachet EN BDD
    public function insert(){
        try{
            $film_id = $this -> film_id;
            $acteur_id = $this -> acteur_id;
            $cachet_tournage = $this-> cachet_tournage;
            $query = $this->connexion->prepare("INSERT INTO " . $this->table . " (film_id, acteur_id, cachet_tournage) VALUES (:film_id, :acteur_id, :cachet_tournage)");
            $query->bindParam(':film_id', $film_id);
            $query->bindParam(':acteur_id', $acteur_id);
            $query->bindParam(':cachet_tournage', $cachet_tournage);
            $query->execute();
            $this -> connexion = null;
            return "";
        }catch(Exception $e)
        {
            // echo $e;
            header('Location: index.php?controller=Cachet');
        }
    }

    // SUPPRIMER UN Cachet
    public function delete()
    {
        $query = $this -> connexion -> prepare("DELETE FROM Jouer WHERE film_id = :film_id AND acteur_id = :acteur_id;");
        $query -> execute(array("film_id"=>$this->film_id, "acteur_id" =>$this->acteur_id));
        $this -> connexion = null;
        return "";
    }

    // RECUPERE LES PROPRIETES d'un cachet en fonction de son ID :
    public function getById($film_id, $acteur_id)
    {
        $query = $this -> connexion -> prepare("SELECT cachet_tournage, film_titre, acteur_nom, acteur_prenom, Jouer.acteur_id, Jouer.film_id FROM Jouer, Acteur, Film WHERE Jouer.film_id = :film_id AND Jouer.acteur_id = :acteur_id AND Jouer.film_id = Film.film_id AND Jouer.acteur_id = Acteur.acteur_id;");
        $query -> execute(array("film_id" => $film_id, "acteur_id" => $acteur_id));
        $result = $query -> fetchObject();
        $this -> connexion = null;
        return $result;
    }

    //modifier un cachet
    public function update()
    {
        try{
        $film_id = $this->film_id;
        $acteur_id = $this->acteur_id;
        $cachet_tournage = $this->cachet_tournage;

        // Requête SQL avec les noms de colonnes corrects
        $query = $this->connexion->prepare("
            UPDATE Jouer
            SET
            cachet_tournage = :cachet_tournage
            WHERE
            film_id = :film_id
            AND
            acteur_id = :acteur_id
        ");

        // Liaison des valeurs aux paramètres dans la requête
        $query->bindValue(':film_id', $film_id, PDO::PARAM_INT);
        $query->bindValue(':acteur_id', $acteur_id, PDO::PARAM_INT);
        $query->bindValue(':cachet_tournage', $cachet_tournage, PDO::PARAM_STR);
        $query->execute();

        $this -> connexion = null;
        return "";
        }catch(Exception $e)
        {
            // echo $e;
            header('Location: index.php?controller=Cachet');
        }
    }
}