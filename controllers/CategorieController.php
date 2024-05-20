<?php

//Le controleur Categorie va permettre de faire le lien entre le modèle et la vue

use FTP\Connection;

class CategorieController
{
    private $connecteur;
    private $connexion;

    // à l'instanciation on attribue la connexion à la base de donnée
    public function __construct()
    {
        require_once __DIR__ . "/../core/Connecteur.php";
        require_once __DIR__ ."/../models/Categorie.php";

        $this -> connecteur = new Connecteur();
        $this -> connexion = $this -> connecteur -> connexion();
    }

    // la méthode run va appelé les méthodes en fonction de l'action correspondante
    public function run($action)
    {
        switch($action)
        {
            case "index":
                $this -> index();
            break;

            case "creation":
                $this -> creation();
            break;

            case "delete":
                $this -> delete();
            break;

            case "detail":
                $this -> detail();
            break;

            case "update":
                $this -> update();
            break;

            default:
                $this -> index();
            break;
        }
    }

    // Ici on récupère tous les Categories pour les afficher dans l'index
    public function index()
    {
        $Categorie = new Categorie($this -> connexion);
        $lesCategories = $Categorie -> getAll();
        $this -> view("categorie", array("Categories" => $lesCategories, "titre" => "Liste de Categories"));
    }

    // creation
    public function creation()
    {
        $Categorie = new Categorie($this -> connexion);
        $Categorie -> setCategorieNom($_POST["nom"]);
        $insert = $Categorie -> insert();
        header('Location: index.php?controller=Categorie');
    }

    // suppression
    public function delete()
    {
        if(isset($_GET["id"]))
        {
            $Categorie = new Categorie($this -> connexion);
            $Categorie -> setCategorieId($_GET["id"]);
            $save = $Categorie -> delete();
            header('Location: index.php?controller=Categorie');
        }
    }

    // On récupère les détails d'un Categorie pour les afficher
    public function detail()
    {
        $Categorie = new Categorie($this -> connexion);
        $uneCategorie = $Categorie -> getById($_GET["id"]);
        $this -> view("detailCategorie", array("Categorie" => $uneCategorie, "titre" => "Categorie"));
    }

    // modification
    public function update()
    {
        if(isset($_POST["id"]))
        {
            $Categorie = new Categorie($this -> connexion);
            $Categorie -> setCategorieId($_POST["id"]);
            $Categorie -> setCategorieNom($_POST["nom"]);
            $save = $Categorie -> update();
            header('Location: index.php?controller=Categorie&action=detail&id='.$_POST["id"]);
        }
    }

    // permet d'aller chercher la Vue correspondante en fonction de ce qu'on a besoin d'afficher à l'utilisateur
    public function view($name, $data)
    {
        require_once __DIR__ . "/../views/".$name."View.php";
    }
}