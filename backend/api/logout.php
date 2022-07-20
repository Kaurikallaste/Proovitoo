<?php
use Proovitoo\Config;
use Proovitoo\Views\AuthView;
use Proovitoo\Controllers\AuthController;

require_once(__DIR__."/../src/Views/AuthView.php");
require_once(__DIR__."/../src/Controllers/AuthController.php");
require_once(__DIR__."/../config/Config.php");

header("Access-Control-Allow-Origin: ".Config::get("frontend.url"));
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json; charset=utf-8');

if(isset($_COOKIE["jsonwebtoken"]) && AuthController::verifyJWT($_COOKIE["jsonwebtoken"])){
    AuthView::instance()->logOutUser();
} else {
    AuthView::instance()->logOutUser();
    http_response_code(401);
}

?>