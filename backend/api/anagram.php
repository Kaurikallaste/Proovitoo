<?php 
use Proovitoo\Config;
use Proovitoo\Controllers\AuthController;
use Proovitoo\Views\AnagramView;
use Proovitoo\Views\AuthView;

require_once(__DIR__."/../src/Views/AnagramView.php");
require_once(__DIR__."/../src/Views/AuthView.php");
require_once(__DIR__."/../src/Controllers/AuthController.php");
require_once(__DIR__."/../config/Config.php");

header("Access-Control-Allow-Origin: ".Config::get("frontend.url"));
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json; charset=utf-8');

if(isset($_COOKIE["jsonwebtoken"]) && AuthController::verifyJWT($_COOKIE["jsonwebtoken"])){
    AnagramView::instance()->handleRequest($_GET);
} else {
    AuthView::instance()->logOutUser();
    http_response_code(401);
}

?>