<?php

namespace Classes;
use PDO;
use Dotenv\Dotenv;

class Db
{

    public PDO $pdoObject;

    public function __construct()
    {
        //should add path of the .env file
        $dotenv = Dotenv::createImmutable(__DIR__ . "\..\\");
        $dotenv->load();

        $dbHost =$_ENV['DB_HOST'];
        $dbName = $_ENV['DB_NAME'];
        $dsn = "mysql:host=$dbHost;dbname=$dbName;";
        $this->pdoObject = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        $this->pdoObject->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdoObject->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    }

    
}