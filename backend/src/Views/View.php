<?php
namespace Proovitoo\Views;

use Exception;

require_once(__DIR__."/../Controllers/AuthController.php");

abstract class View {
    protected static $controller;
    protected static $instance;

    function __construct($controller) {
        self::$controller = $controller::instance();
    }

    abstract static function instance(): View;

    abstract function handleRequest($data): void;

    function returnErrJson(Exception $e): void {
        http_response_code(500);
        echo json_encode(["message" => $e->getMessage()]);
    }
}
?>