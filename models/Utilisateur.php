<?php

class Utilisateur
{

    private $table="Utilisateur";
    private $connexion;

    private $utilisateur_id;
    private $utilisateur_login;
    private $utilisateur_pass;

    public function __construct($connexion)
    {
        $this -> connexion = $connexion;
    }

    //SETTER

    public function setUtilisateurId($id)
    {
        $this -> utilisateur_id = $id;
    }

    public function setUtilisateurLogin($login)
    {
        $this -> utilisateur_login = $login;
    }

    public function setUtilisateurPass($pass)
    {
        $this -> utilisateur_pass = password_hash($pass, PASSWORD_DEFAULT);
    }

    

    public function authenticate($utilisateur_login, $utilisateur_pass) {
        $query = "SELECT * FROM Utilisateur WHERE utilisateur_login = :utilisateur_login";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam(':utilisateur_login', $utilisateur_login);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $currentDate = date('Y-m-d');

        if ($user && password_verify($utilisateur_pass, $user['utilisateur_pass'])) {
            $query = $this->connexion->prepare("
            INSERT INTO Log (log_success, log_date, utilisateur_id)
            VALUES (1, :date, :utilisateur_id);
            ");
            $query->bindParam(':date', $currentDate);
            $query->bindParam(':utilisateur_id', $user['utilisateur_id']);
            $query->execute();
            return true;
        } else {
            $query = $this->connexion->prepare("
            INSERT INTO Log (log_success, log_date, utilisateur_id)
            VALUES (0, :date, :utilisateur_id);
            ");
            $query->bindParam(':date', $currentDate);
            $query->bindParam(':utilisateur_id', $user['utilisateur_id']);
            $query->execute();
            return false;
        }
    }

    public function insert(){
        try{
            $login = $this->utilisateur_login;
            $pass = $this -> utilisateur_pass;
            $query = $this->connexion->prepare("INSERT INTO " . $this->table . " (utilisateur_login, utilisateur_pass) VALUES (:login, :pass)");
            $query->bindParam(':login', $login);
            $query->bindParam(':pass', $pass);
            $query->execute();
            $this -> connexion = null;
            return true;
        }catch(Exception $e)
        {
            // echo $e;
            return false;
        }
    }
}