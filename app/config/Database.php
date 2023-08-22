<?php

namespace App\config;

/**
 * CONNECTION A LA BDD
 */ 
class Database extends \PDO {

    public function __construct(){

        $conn = 'mysql:dbname=matthc_jobboard;host=127.0.0.1';
        $user = 'SUBSKILL';
        $password = 'SUBSKILL';
    
       parent::__construct($conn, $user, $password);
    }


}