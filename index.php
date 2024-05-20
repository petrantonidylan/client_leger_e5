<?php

require_once 'config/global.php';
session_start();

// Vérifie s'il y a un paramètre "controller" dans la requête GET (via $_GET)
//si oui il charge le contrôleur correspondant en appelant la fonction loadController()
if(isset($_GET["controller"]))
{
    if(isset($_SESSION['utilisateur_login'])){
        $controllerObj = loadController($_GET["controller"]);
        loadAction($controllerObj);
    }else
    {
        $controllerObj = loadController("Connexion");
        loadAction($controllerObj);
    }
}else{
    if(isset($_SESSION['utilisateur_login'])){
        $controllerObj = loadController(CONTROLLER_DEFAULT);
        loadAction($controllerObj);
    }else
    {
        $controllerObj = loadController("Connexion");
        loadAction($controllerObj);
    }
}


// C'est une fonction qui charge le contrôleur en fonction du nom du contrôleur passé en paramètre
// Dans ce cas, il y a un cas particulier pour le contrôleur "Film", et un contrôleur par défaut est utilisé pour les autres cas

function loadController($controller)
{
    switch($controller)
    {
        case 'Film' :
            $strFileController='controllers/FilmController.php';
            require_once $strFileController;
            $controllerObj = new FilmController();
        break;

        case 'Categorie' :
            $strFileController='controllers/CategorieController.php';
            require_once $strFileController;
            $controllerObj = new CategorieController();
        break;

        case 'Acteur' :
            $strFileController='controllers/ActeurController.php';
            require_once $strFileController;
            $controllerObj = new ActeurController();
        break;

        case 'Cachet' :
            $strFileController='controllers/CachetController.php';
            require_once $strFileController;
            $controllerObj = new CachetController();
        break;

        case 'Connexion' :
            $strFileController='controllers/ConnexionController.php';
            require_once $strFileController;
            $controllerObj = new ConnexionController();
        break;

        default:
            $strFileController = 'controllers/FilmController.php';
            require_once $strFileController;
            $controllerObj = new FilmController();
        break;
    }
    return $controllerObj;
}

// Cette fonction charge l'action du contrôleur en fonction du paramètre "action" de la requête GET
// Si aucun paramètre "action" n'est fourni, elle utilise l'action par défaut définie dans global.php

function loadAction($controllerObj)
{
    if(isset($_GET["action"]))
    {
        $controllerObj -> run($_GET["action"]);
    }
    else
    {
        $controllerObj -> run(ACTION_DEFAULT);
    }
}

?>