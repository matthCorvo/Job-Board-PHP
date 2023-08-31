<?php

/**
 * CONNECTION A LA BDD
 */ 
function connect(){
    $conn = new PDO("mysql:host=mysql-codesaver.alwaysdata.net;dbname=codesaver_main", "codesaver", "Cyprie971!");
    return $conn;
}

// Call the connect() function to establish a database connection
$conn = connect();
