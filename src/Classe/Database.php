<?php

namespace App\Classe;

use PDO;
use PDOException;

class Database
{
    private string $host = "localhost";
    private string $db = "bibliotheque";
    private string $username = "root";
    private string $password = "";
    private static ?PDO $dbInstance = null;

    /**
     * Database constructor
     */
    public function __construct() {
        try {
            self::$dbInstance = new PDO("mysql:host = $this->host;dbname=$this->db;charset=utf8", $this->username, $this->password);
            self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$dbInstance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Return only one PDO instance through the whole project.
     * @return PDO|null (instance) PDO|null
     */
    public static function getInstance(): ?PDO {
        if (null === self::$dbInstance) {
            new self();
        }
        return self::$dbInstance;
    }

    /**
     * Return sanitized string to have secure data to insert into the database.
     * @param $data
     * @return string
     */
    public static function sanitizeString($data): string {
        $data = strip_tags($data);
        $data = addslashes($data);
        return trim($data);
    }

    /**
     * Return sanitized int to have secure data to insert into the database.
     * @param $data
     * @return int
     */
    public static function sanitizeInt($data): int {
        return intval($data);
    }

    /**
     * We prevent letting other developers clone the object
     */
    public function __clone(){}
}