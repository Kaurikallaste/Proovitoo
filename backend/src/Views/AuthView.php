<?php
require_once(__DIR__."/../Controllers/AuthController.php");
require_once("View.php");

class AuthView extends View {

    public static function instance(): AuthView {
        if (self::$instance === null)
        {
            self::$instance = new self(AuthController::instance());
        }
        return self::$instance;
    }

    /**
     * Handle POST request made to /auth endpoint
     * 
     * @param $data $_POST 
     */
    public function handleRequest($data): void {
        $name = trim($data["name"]);
        $password = trim($data["password"]);

        if(!empty($name) && !empty($password)) {
            try {
                http_response_code(200);
                self::$controller->authUser($name, $password);
            } catch(Exception $e) {
                $this->returnErrJson($e);
            }
        } else {
            echo empty($name) ? json_encode(["message" => "No username"]) : json_encode(["message" => "No password"]);
            http_response_code(401);
        }
    }

    /**
     * Handle GET request made to /logout endpoint
     */
    public function logOutUser(): void {
        self::$controller::logOutUser();
    }
}
