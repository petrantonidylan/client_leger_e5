<?php

//Le controleur Acteur va permettre de faire le lien entre le modèle et la vue

use FTP\Connection;

class ActeurController
{
    private $connecteur;
    private $connexion;

    // à l'instanciation on attribue la connexion à la base de donnée
    public function __construct()
    {
        require_once __DIR__ . "/../core/Connecteur.php";
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

    // Ici on récupère tous les Acteurs pour les afficher dans l'index
    public function index()
    {
        $Acteur = new Acteur($this -> connexion);
        $lesActeurs = $Acteur -> getAll();
        $this -> view("Acteur", array("Acteurs" => $lesActeurs, "titre" => "Liste de Acteurs"));
    }

    // creation
    public function creation()
    {
        $Acteur = new Acteur($this -> connexion);
        $Acteur -> setActeurNom($_POST["nom"]);
        $Acteur -> setActeurPrenom($_POST["prenom"]);
        $insert = $Acteur -> insert();
        header('Location: index.php?controller=Acteur');
    }

    // suppression
    public function delete()
    {
        if(isset($_GET["id"]))
        {
            $Acteur = new Acteur($this -> connexion);
            $Acteur -> setActeurId($_GET["id"]);
            $save = $Acteur -> delete();
            header('Location: index.php?controller=Acteur');
        }
    }

    // On récupère les détails d'un Acteur pour les afficher
    public function detail()
    {
        $Acteur = new Acteur($this -> connexion);
        $unActeur = $Acteur -> getById($_GET["id"]);
        $this -> view("detailActeur", array("Acteur" => $unActeur, "titre" => "Acteur"));
    }

    // modification
    public function update()
    {
        if(isset($_POST["id"]))
        {
            $Acteur = new Acteur($this -> connexion);
            $Acteur -> setActeurId($_POST["id"]);
            $Acteur -> setActeurNom($_POST["nom"]);
            $Acteur -> setActeurPrenom($_POST["prenom"]);
            $save = $Acteur -> update();
            header('Location: index.php?controller=Acteur&action=detail&id='.$_POST["id"]);
        }
    }

    // permet d'aller chercher la Vue correspondante en fonction de ce qu'on a besoin d'afficher à l'utilisateur
    public function view($name, $data)
    {
        require_once __DIR__ . "/../views/".$name."View.php";
    }
}