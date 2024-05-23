<?php

// On créé un modèle Film qui va servir à manipuler notre table film dans la base de donnée
// Il contient la logique métier
class Film
{

    private $table="film";
    private $connexion;

    // On créé autant de propriété qu'il y en a dans la table film de la base
    private $film_id;
    private $film_titre;
    private $film_description;
    private $film_date;
    private $film_image;
    private $film_note;
    private $film_lien;
    private $categorie_id;

    public function __construct($connexion)
    {
        $this -> connexion = $connexion;
    }

    // LES GETTERS pour récupérer la valeur des propriétés :

    public function getFilmId()
    {
        return $this -> film_id;
    }

    public function getFilmTitre()
    {
        return $this -> film_titre;
    }

    public function getFilmDescription()
    {
        return $this -> film_description;
    }

    public function getFilmDate()
    {
        return $this -> film_date;
    }

    public function getFilmImage()
    {
        return $this -> film_image;
    }

    public function getFilmNote()
    {
        return $this -> film_note;
    }

    public function getFilmLien()
    {
        return $this -> film_lien;
    }

    public function getCategorieId()
    {
        return $this -> categorie_id;
    }

    // LES SETTERS pour attribuer une valeur à chaque propriété:
    
    public function setFilmId($id)
    {
        $this -> film_id = $id;
    }

    public function setFilmTitre($titre)
    {
        $this -> film_titre = $titre;
    }

    public function setFilmDescription($description)
    {
        $this -> film_description = $description;
    }

    public function setFilmDate($date)
    {
        $this -> film_date = $date;
    }

    public function setFilmImage($image)
    {
        $this -> film_image = $image;
    }

    public function setFilmNote($note)
    {
        $this -> film_note = $note;
    }

    public function setFilmLien($lien)
    {
        $this -> film_lien = $lien;
    }

    public function setCategorieId($categorie_id)
    {
        $this -> categorie_id = $categorie_id;
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

    public function getFilmsByCategorie($categorie_id)
    {
        $query = $this -> connexion -> prepare("SELECT * FROM ".$this -> table." WHERE categorie_id = :categorie_id ");
        $query->bindParam(':categorie_id', $categorie_id);
        $query -> execute();
        $result = $query -> fetchAll();
        $this -> connexion = null;
        return $result;
    }

    // INSERT D'UN FILM EN BDD
    public function insert(){
        try{
            $titre = $this -> film_titre; $description = $this -> film_description; $date = $this -> film_date; $note = $this -> film_note; $image = $this -> film_image; $lien = $this -> film_lien;$categorie_id = $this -> categorie_id;
            $query = $this->connexion->prepare("INSERT INTO " . $this->table . " (film_titre, film_description, film_date, film_note, film_image, film_lien, categorie_id) VALUES (:titre, :description, :date, :note, :image, :lien, :categorie_id)");
            $query->bindParam(':titre', $titre);
            $query->bindParam(':description', $description);
            $query->bindParam(':date', $date);
            $query->bindParam(':note', $note);
            $query->bindParam(':image', $image);
            $query->bindParam(':lien', $lien);
            $query->bindParam(':categorie_id', $categorie_id);
            $query->execute();
            $this -> connexion = null;
            return "";
        }catch(Exception $e)
        {
            // echo $e;
            header('Location: index.php');
        }
    }

    // SUPPRIMER UN FILM
    public function delete()
    {
        $query = $this -> connexion -> prepare("DELETE FROM ".$this->table." WHERE film_id = :id");
        $query -> execute(array("id"=>$this->film_id));
        $this -> connexion = null;
        return "";
    }

    // RECUPERE LES PROPRIETES d'un film en fonction de son ID :
    public function getById($id)
    {
        $query = $this -> connexion -> prepare("SELECT Film.film_id, film_titre, film_note, film_description, film_date, Categorie.categorie_nom, film_lien, film_image, Film.categorie_id FROM ".$this -> table.", Categorie WHERE Film.film_id = :id AND film.categorie_id = categorie.categorie_id");
        $query -> execute(array("id" => $id));
        $result = $query -> fetchObject();
        $this -> connexion = null;
        return $result;
    }

    // modifier un film
    public function update()
    {
        try{
        $film_id = $this->film_id;
        $titre = $this->film_titre;
        $description = $this->film_description;
        $date = $this->film_date;
        $note = $this->film_note;
        $image = $this->film_image;
        $lien = $this->film_lien;
        $categorie_id = $this->categorie_id;

        // Requête SQL avec les noms de colonnes corrects
        $query = $this->connexion->prepare("
            UPDATE Film
            SET
            film_titre = :titre,
            film_description = :description,
            film_date = :date,
            film_image = :image,
            film_note = :note,
            film_lien = :lien,
            categorie_id = :categorie_id
            WHERE
            film_id = :film_id
        ");

        // Liaison des valeurs aux paramètres dans la requête
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
        $query->bindValue(':date', $date, PDO::PARAM_STR);
        $query->bindValue(':note', $note, PDO::PARAM_INT);
        $query->bindValue(':image', $image, PDO::PARAM_STR);
        $query->bindValue(':lien', $lien, PDO::PARAM_STR);
        $query->bindValue(':categorie_id', $categorie_id, PDO::PARAM_INT);
        $query->bindValue(':film_id', $film_id, PDO::PARAM_INT);
        $query->execute();

        $this -> connexion = null;
        return "";
        }catch(Exception $e)
        {
            // echo $e;
            header('Location: index.php');
        }
    }

    public function getByCategorieId($id)
    {
        $query = $this -> connexion -> prepare("SELECT * FROM ".$this -> table." WHERE Film.categorie_id = :id");
        $query -> execute(array("id" => $id));
        $result = $query -> fetchObject();
        $this -> connexion = null;
        return $result;
    }
}