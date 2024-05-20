<?php

use FTP\Connection;

class ConnexionController
{
    private $connecteur;
    private $connexion;

    // à l'instanciation on attribue la connexion à la base de donnée
    public function __construct()
    {
        require_once __DIR__ . "/../core/Connecteur.php";
        require_once __DIR__ ."/../models/Utilisateur.php";

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

            case "logout":
                $this -> logout();
            break;

            case "inscription":
                $this -> inscription();
            break;

            default:
                $this -> index();
            break;
        }
    }

    public function index()
    {
        $this -> view("connexion", array());

        if(isset($_POST["login"]) && isset($_POST["pass"])){
            $unUtilisateur = new Utilisateur($this->connexion);
            if($unUtilisateur->authenticate($_POST["login"], $_POST["pass"]))
            {
                $_SESSION['utilisateur_login'] = $_POST["login"];
                header('Location: index.php?controller=Film');
                exit;
            }else
            {
                echo "Identifiants invalides";
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: index.php?controller=Connexion');
    }

    public function inscription(){
        $this -> view("inscription", array());

        if(isset($_POST["login"]) && isset($_POST["pass"])){
            $unUtilisateur = new Utilisateur($this->connexion);
            $unUtilisateur->setUtilisateurLogin($_POST["login"]);
            $unUtilisateur->setUtilisateurPass($_POST["pass"]);

            if($unUtilisateur -> insert())
            {
                $_SESSION['utilisateur_login'] = $_POST["login"];
                header('Location: index.php?controller=Film');
                exit;
            }else
            {
                echo "Login déjà pris.";
            }
        }
    }

    public function view($name, $data)
    {
        require_once __DIR__ . "/../views/".$name."View.php";
    }
}