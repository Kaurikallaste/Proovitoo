<?php 
require_once(__DIR__."/../Controllers/DatasetController.php");
require_once("View.php");

class DatasetView extends View {
    public static function instance(): DatasetView {
        if(self::$instance === null)
        {
            self::$instance = new self(DatasetController::instance());
        }
        return self::$instance;
    }

    /**
     * Handle POST request made to /dataset endpoint
     * 
     * @param $data $_POST 
     */
    public function handleRequest($data): void {
        if(isset($data["File"])) {
            try {
                http_response_code(200);
                $path = $data["File"]["full_path"];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                switch($ext){
                    case "txt":
                        $dataset = self::$controller->handleTextDataset($data);
                        self::$controller->saveDataset($dataset);
                        echo json_encode(["success" => "Dataset ${path} uploaded"]);
                        break;
                    default:
                        http_response_code(400);
                        echo json_encode(["error" => "Filetype not supported"]);
                        break;
                }
            } catch(Exception $e) {
                $this->returnErrJson($e);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Choose a file to upload"]);
        }
    }
}
