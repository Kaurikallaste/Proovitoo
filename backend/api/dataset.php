<?php
require_once(__DIR__."/../src/Views/DatasetView.php");
require_once(__DIR__."/../src/Views/AuthView.php");
require_once(__DIR__."/../config/config.php");

header("Access-Control-Allow-Origin: ".Config::get("frontend.url"));
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json; charset=utf-8');

if(isset($_COOKIE["jsonwebtoken"]) && AuthController::verifyJWT($_COOKIE["jsonwebtoken"])){
    DatasetView::instance()->handleRequest($_FILES);
} else {
    AuthView::instance()->logOutUser();
    http_response_code(401);
}

?>