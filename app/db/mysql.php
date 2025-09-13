<?php 

namespace App\db;

class Mysql
{
    private $db_name;
    private $db_user;
    private $db_password;
    private $db_port;
    private $db_host;
    private $pdo = null;
    private static $_instance = null;

    private function __construct()
    {
        // ajouter \ pour constante globale
        $conf = require_once __DIR__ . '/../../config.php';

        $this->db_name = $conf['db_name'] ?? null;
        $this->db_user = $conf['db_user'] ?? null;
        $this->db_password = $conf['db_password'] ?? null;
        $this->db_port = $conf['db_port'] ?? 3306;
        $this->db_host = $conf['db_host'] ?? 'localhost';
    }

    public static function getInstance(): self
    {
        if (is_null(self::$_instance)){
            self::$_instance = new Mysql(); // majuscule correcte
        }
        return self::$_instance;
    }

    public function getPDO(): \PDO
    {
        if (is_null($this->pdo)) {
            $this->pdo = new \PDO(
                'mysql:host=' . $this->db_host . ';port=' . $this->db_port . ';dbname=' . $this->db_name . ';charset=utf8',
                $this->db_user,
                $this->db_password
            );
        }
        return $this->pdo;
    }
}
