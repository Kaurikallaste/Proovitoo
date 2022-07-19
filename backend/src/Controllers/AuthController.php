<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require(__DIR__."/../../vendor/autoload.php");
require_once(__DIR__."/../Models/User.php");
require_once("Controller.php");

class AuthController extends Controller {

    public static function instance(): AuthController {
        if(self::$instance === null)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function authUser($name, $password) {
        $userData = self::$db->fetch("SELECT * FROM users WHERE name=?",[$name]);

        if(empty($userData)) {
            http_response_code(401);
            echo json_encode(["error" => "Invalid username"]);
            return null;
        }

        if(password_verify($password, $userData["password"])) {
            $user = new User($userData["name"], $userData["id"]);
            $jwt = $this->generateJWT($user);
            $options = [
                "expires" => time() + 60*60*24*30,
                "path" => "/",
                "httponly" => true,
                "samesite" => "strict"
                //secure
            ];
            $optionsisLoggedIn = [
                "expires" => time() + 60*60*24*30,
                "path" => "/",
                "samesite" => "strict"
                //secure
            ];
            setcookie("jsonwebtoken", $jwt, $options);
            setcookie("isloggedin", "true", $optionsisLoggedIn);
        } else {
            http_response_code(401);
            echo json_encode(["error" => "Invalid password"]);
        }
    }

    /**
     * generate JWT for user
     * 
     * @param User $user
     * 
     * @return string Json Web Token
     */
    private function generateJWT($user): string {
        $key = Config::get("jwt.key");
        $payload = [
            'name' => $user->getName(),
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 60*60*24
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    /**
     * verify that JWT is valid
     * 
     * @param string $jwt
     * 
     * @return bool 
     */
    public static function verifyJWT($jwt): bool {
        $key = Config::get("jwt.key");
        try {
            $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

            if ($decoded->nbf < time() ||
                $decoded->exp > time()) {
                return true;
            } else {
                self::logOutUser();
                return false;
            }
        } catch (Exception $e) {
            self::logOutUser();
            return false;
        }
    }

    /**
     * Unset User Cookies
     */
    public static function logOutUser(): void {
        $options = [
            "expires" => 1,
            "path" => "/",
            "httponly" => true,
            "samesite" => "strict"
        ];
        setcookie("jsonwebtoken", "", $options); //secure ka aga mul pole HTTPS hetkel
        setcookie("isloggedin", "", $options);
    }
}
