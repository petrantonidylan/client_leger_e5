<?php

//Le controleur Film va permettre de faire le lien entre le modèle et la vue

use FTP\Connection;

class FilmController
{
    private $connecteur;
    private $connexion;

    // à l'instanciation on attribue la connexion à la base de donnée
    public function __construct()
    {
        require_once __DIR__ . "/../core/Connecteur.php";
        require_once __DIR__ ."/../models/Film.php";
        require_once __DIR__ ."/../models/Categorie.php";
        require_once __DIR__ ."/../models/Log.php";

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

            case "log":
                $this -> log();
            break;

            default:
                $this -> index();
            break;
        }
    }

    // Ici on récupère tous les films pour les afficher dans l'index
    public function index()
    {
        $Film = new Film($this -> connexion);
        $Categorie = new Categorie($this -> connexion);

        if(isset($_POST['categorie_'])){
            $lesFilms = $Film->getFilmsByCategorie($_POST['categorie_']);

        }else{
            $lesFilms = $Film -> getAll();
        }
        $lesCategories = $Categorie -> getAll();

        $this -> view("film", array("films" => $lesFilms, "titre" => "Liste de films", "categories" => $lesCategories));
    }

    // creation
    public function creation()
    {
        $Film = new Film($this -> connexion);
        $Film -> setFilmTitre($_POST["titre"]);
        $Film -> setFilmDescription($_POST["description"]);
        $Film -> setFilmDate($_POST["date"]); 
        $Film -> setFilmNote($_POST["note"]);
        $Film -> setFilmImage($_POST["image"]);
        $Film -> setFilmLien($_POST["lien"]);
        $Film -> setCategorieId($_POST["categorie"]);
        $insert = $Film -> insert();
        header('Location: index.php?controller=Film');
    }

    // suppression
    public function delete()
    {
        if(isset($_GET["id"]))
        {
            $Film = new Film($this -> connexion);
            $Film -> setFilmId($_GET["id"]);
            $save = $Film -> delete();
            header('Location: index.php');
        }
    }

    // On récupère les détails d'un film pour les afficher
    public function detail()
    {
        $Categorie = new Categorie($this -> connexion);
        $lesCategories = $Categorie -> getAll();
        $Film = new Film($this -> connexion);
        $unFilm = $Film -> getById($_GET["id"]);
        $this -> view("detailFilm", array("film" => $unFilm, "titre" => "Film", "categories" => $lesCategories));
    }

    // modification
    public function update()
    {
        if(isset($_POST["id"]))
        {
            $Film = new Film($this -> connexion);
            $Film -> setFilmId($_POST["id"]);
            $Film -> setFilmTitre($_POST["titre"]);
            $Film -> setFilmDescription($_POST["description"]);
            $Film -> setFilmDate($_POST["date"]); 
            $Film -> setFilmNote($_POST["note"]);
            $Film -> setFilmImage($_POST["image"]);
            $Film -> setFilmLien($_POST["lien"]);
            $Film -> setCategorieId($_POST["categorie"]);
            $save = $Film -> update();
            header('Location: index.php?controller=film&action=detail&id='.$_POST["id"]);
        }
    }

    public function log(){
        $Log = new Log($this -> connexion);
        $lesLogs = $Log -> getAll();
        $this -> view("log", array("logs" => $lesLogs));
    }

    // permet d'aller chercher la Vue correspondante en fonction de ce qu'on a besoin d'afficher à l'utilisateur
    public function view($name, $data)
    {
        require_once __DIR__ . "/../views/".$name."View.php";
    }
}