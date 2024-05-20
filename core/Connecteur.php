<?php
    //Classe Connecteur qui va servir à se connecter à notre base de donnée
    class Connecteur
    {
        //propriété privés qui vont stocker les infos
        private $driver;
        private $host, $user, $pass, $database, $charset;

        //La fonction construct va attribuer aux propriétés, à l'instanciation, les infos qu'on a stocké dans "config"
        public function __construct()
        {
            $db_cfg = require_once 'config/database.php';
            $this -> driver = DB_DRIVER;
            $this -> host = DB_HOST;
            $this -> user = DB_USER;
            $this -> pass = DB_PASS;
            $this -> database = DB_DATABASE;
            $this -> charset = DB_CHARSET;
        }
        // Méthode pour établir la connexion en utilisant les informations de connexion à la base de données stockées
        public function connexion()
        {
            // $bdd = $this -> driver.':host='.$this -> host . ';dbname='. $this -> database.';charset='.$this -> charset;
            try{
                $connection = new PDO("sqlsrv:Server=DYLAN\\SQLEXPRESS;Database=".$this->database, $this->user, $this->pass);
                $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $connection;

            }catch(PDOException $e)
            {
                echo $e;
                throw new Exception('Problème de connexion à la base de donnée. Merci de prévenir l\'administrateur');
            }
        }
    }

?>