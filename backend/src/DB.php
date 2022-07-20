<?php
namespace Proovitoo;

use PDO;
use PDOException;
use Proovitoo\Config;

require_once(__DIR__.'/../config/Config.php');

class DB {
    private static $instance;
    private $pdo;

    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    function __construct() {
        try {
            $dsn = "mysql:host=".Config::get('database.host').";dbname=".Config::get('database.database');
            $this->pdo = new PDO($dsn, Config::get('database.username'), Config::get('database.password'), $this->options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function instance(): DB {
        if (self::$instance === null)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function fetchAll($sql, $args = []): ?Array {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($args);
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function fetch($sql, $args = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($args);
            return $stmt->fetch();
        } catch(PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function insert($sql, $args = []): ?int {
        try {
            $stmt = $this->pdo->prepare($sql);

            $this->pdo->beginTransaction();
            foreach($args as $row){
                $stmt->execute($row);
            }
            $this->pdo->commit();
            return $this->pdo->lastInsertId();
        } catch(PDOException $e) {
            //$this->pdo->rollBack();
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
        return NULL;
    }
}
?>
