<?php

//Le controleur Cachet va permettre de faire le lien entre le modèle et la vue

use FTP\Connection;

class CachetController
{
    private $connecteur;
    private $connexion;

    // à l'instanciation on attribue la connexion à la base de donnée
    public function __construct()
    {
        require_once __DIR__ . "/../core/Connecteur.php";
        require_once __DIR__ ."/../models/Cachet.php";
        require_once __DIR__ ."/../models/Film.php";
        require_once __DIR__ ."/../models/Acteur.php";

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

    // Ici on récupère tous les Cachets pour les afficher dans l'index
    public function index()
    {
        $Cachet = new Cachet($this -> connexion);
        $lesCachets = $Cachet -> getAll();
        $Film = new Film($this -> connexion);
        $lesFilms = $Film -> getAll();
        $Acteur = new Acteur($this -> connexion);
        $lesActeurs = $Acteur -> getAll();
        $this -> view("cachet", array("Cachets" => $lesCachets, "titre" => "Liste de Cachets", "Films" => $lesFilms, "Acteurs" => $lesActeurs));
    }

    // creation
    public function creation()
    {
        $Cachet = new Cachet($this -> connexion);
        $Cachet -> setFilmId($_POST["film_id"]);
        $Cachet -> setActeurId($_POST["acteur_id"]);
        $Cachet -> setCachetTournage($_POST["cachet_tournage"]);
        $insert = $Cachet -> insert();
        header('Location: index.php?controller=Cachet');
    }

    // suppression
    public function delete()
    {
        if(isset($_GET["film_id"]) && isset($_GET["acteur_id"]))
        {
            $Cachet = new Cachet($this -> connexion);
            $Cachet -> setFilmId($_GET["film_id"]);
            $Cachet -> setActeurId($_GET["acteur_id"]);
            $save = $Cachet -> delete();
            header('Location: index.php?controller=Cachet');
        }
    }

    // On récupère les détails d'un Cachet pour les afficher
    public function detail()
    {
        if(isset($_GET["film_id"]) && isset($_GET["acteur_id"]))
        {
            $Cachet = new Cachet($this -> connexion);
            $unCachet = $Cachet -> getById($_GET["film_id"], $_GET["acteur_id"]);
            $this -> view("detailCachet", array("Cachet" => $unCachet, "titre" => "Cachet"));
        }
    }

    // modification
    public function update()
    {
        if(isset($_POST["film_id"]) && isset($_POST["acteur_id"]))
        {
            $Cachet = new Cachet($this -> connexion);
            $Cachet -> setFilmId($_POST["film_id"]);
            $Cachet -> setActeurId($_POST["acteur_id"]);
            $Cachet -> setCachetTournage($_POST["cachet_tournage"]);
            $save = $Cachet -> update();
            header('Location: index.php?controller=Cachet&action=detail&film_id='.$_POST["film_id"].'&acteur_id='.$_POST["acteur_id"]);
        }
    }

    // permet d'aller chercher la Vue correspondante en fonction de ce qu'on a besoin d'afficher à l'utilisateur
    public function view($name, $data)
    {
        require_once __DIR__ . "/../views/".$name."View.php";
    }
}