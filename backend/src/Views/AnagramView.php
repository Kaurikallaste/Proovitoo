<?php
require_once(__DIR__."/../Controllers/AnagramController.php");
require_once("View.php");

class AnagramView extends View {

    public static function instance(): AnagramView {
        if (self::$instance === null)
        {
            self::$instance = new self(AnagramController::instance());
        }
        return self::$instance;
    }

    /**
     * Handle GET request made to /anagram endpoint
     * 
     * @param $data $_GET 
     */
    public function handleRequest($data): void {
        if(!empty($data["word"])){
            try {
                http_response_code(200);
                $anagrams = self::$controller->getAnagrams($data["word"]);
                echo json_encode(["word" => $data["word"], "anagrams" => $anagrams]);
            } catch(Exception $e) {
                $this->returnErrJson($e);
            }
        } else {
            http_response_code(400);
            echo json_encode(["anagrams" => [], "message" => "Please type a word into the input field"]);
        }
    }
}
?>