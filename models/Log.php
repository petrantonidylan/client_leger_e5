<?php

class Log
{

    private $table="Log";
    private $connexion;

    private $log_id;
    private $log_date;
    private $log_success;


    public function __construct($connexion)
    {
        $this -> connexion = $connexion;
    }


    public function getAll()
    {
        $query = $this -> connexion -> prepare("SELECT log_id, log_date, log_success, utilisateur_login FROM Log, Utilisateur WHERE Utilisateur.utilisateur_id =  Log.utilisateur_id");
        $query -> execute();
        $result = $query -> fetchAll();
        $this -> connexion = null;
        return $result;
    }

}