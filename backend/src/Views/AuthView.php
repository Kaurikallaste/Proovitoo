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
                echo json_encode(["success" => "success"]);
            } catch(Exception $e) {
                $this->returnErrJson($e);
            }
        } else {
            echo json_encode(["error" => "No user credentials"]);
            http_response_code(401);
        }
    }

    public function logOutUser(): void {
        self::$controller::logOutUser();
    }

    public function verifyUser($jwt): bool {
        return self::$controller->verifyJWT($jwt);
    }
}
