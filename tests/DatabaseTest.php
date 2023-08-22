<?php   

namespace App\Tests;

use PHPUnit\Framework\TestCase;


use PDO;

class DatabaseTest extends TestCase
{
    private $pdo;

    public function setUp(): void
    {
        parent::setUp();
        // Initialize your PDO connection here
        $this->pdo = new PDO('mysql:host=localhost;dbname=matthc_jobboard', 'SUBSKILL', 'SUBSKILL');
    }

    public function testDatabaseConnection()
    {
        // Your database connection test code goes here
        $this->assertInstanceOf(PDO::class, $this->pdo);
    }
}