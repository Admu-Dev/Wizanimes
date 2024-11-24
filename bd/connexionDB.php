<?php

  class connexionDB {
    private $host    = 'localhost';   // nom de l'host
    private $name    = '';     // nom de la base de donnée
    private $user    = '';        // utilisateur
    private $pass    = '';        // mot de passe

	// Hostinger
    private $name2   = '';     // nom de la base de donnée
    private $user2    = '';        // utilisateur
    private $pass2    = '';        // mot de passe
    private $connexion;
	
		function __construct($host = null, $name = null, $user = null, $pass = null, $name2 = null, $user2 = null, $pass2 = null){
			if($host != null){
				$this->host = $host;
				$this->name = $name;
				$this->user = $user;
				$this->pass = $pass;
				$this->name2 = $name2;
				$this->user2 = $user2;
				$this->pass2 = $pass2;
			}
			
			try{
				$this->connexion = new PDO('mysql:host='.$this->host.';dbname='.$this->name,
				$this->user,$this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8mb4', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			}catch (PDOException $e){
				try{
					$this->connexion = new PDO('mysql:host='.$this->host.';dbname='.$this->name2,
					$this->user2,$this->pass2,array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8mb4', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
				}catch (PDOException $e){
					echo 'Erreur : Impossible de se connecter  à la BDD !';
					die();
				}
			}
		}
		
		public function connexion(){
			return $this->connexion;
		}
	}

	$BDD = new connexionDB();
	$DB = $BDD->connexion(); 

?>