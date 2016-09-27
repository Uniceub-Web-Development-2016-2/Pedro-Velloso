<?php
class DBConnector extends PDO {
   
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
    private $connector;	
   
    public function __construct(){
        $this->engine = 'mysql';
        $this->host = 'localhost';
        $this->database = 'aula';
        $this->user = 'root';
        $this->pass = '';
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        $this->connector = parent::__construct( $dns, $this->user, $this->pass );
    }

    public function results(){
        $this->connector->fecthAll();
    }


		
}