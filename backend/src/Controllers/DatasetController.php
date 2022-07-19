<?php
require_once(__DIR__."/../Models/Word.php");
require_once("Controller.php");

class DatasetController extends Controller {

    public static function instance(): DatasetController {
        if(self::$instance === null)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Save dataset to the database
     * 
     * @param $dataset array of strings
     */
    public function saveDataset($dataset): void {
        self::$db->insert("INSERT IGNORE INTO words(word) VALUES(:word)", $dataset);
    }

    /**
     * Parse text file into Word object array
     * 
     * @param @data $_POST variable
     * 
     * @return array $dataset array of strings
     */
    public function handleTextDataset($data): array {
        $file = fopen($data["File"]["tmp_name"],"r");
        
        $dataset = [];
    
        while ($line = fgets($file)) {
            if(!empty(trim($line))){
                $word = new Word($line);
                array_push($dataset, [$word->getWord()]);
            }
        }
        fclose($file);
        return $dataset;
    }
}   
?>