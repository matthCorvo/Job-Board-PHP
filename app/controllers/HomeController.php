<?php   



namespace App\Controllers;

use App\config\Database;

use PDOException;

class HomeController {

    public function __construct()
    {
        try {
            $db = new Database();
            echo "Database connection established successfully.";
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
        }
    }

}