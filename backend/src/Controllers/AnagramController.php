<?php
namespace Proovitoo\Controllers;

use Proovitoo\Models\Word;

require_once("Controller.php");
require_once(__DIR__."/../Models/Word.php");

class AnagramController extends Controller {

    public static function instance(): AnagramController {
        if (self::$instance === null)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Get all anagrams of given word
     * 
     * @param String $searchWord 
     * 
     * @return Array $res anagrams of $searchWord
     */
    public function getAnagrams($searchWord): Array {
        $word = new Word($searchWord);
        $dataset = $this->getCleanDataset($this->getDataset());

        $res = [];
        foreach($dataset as $compWord){
            if($word->getChars() == $compWord->getChars()){
                if($word->getWord() != $compWord->getWord()){ // Word is not an anagram for itself
                    array_push($res, $compWord->getWord());
                }
            }
        }

        return $res;
    }

    /**
     * Get dataset from database
     * 
     * @return Array $dataset
     */
    private function getDataset(): Array {
        return self::$db->fetchAll("SELECT word FROM words");
    }

    /**
     * Get clean dataset
     * 
     * @param Array $dataset dataset from database
     * 
     * @return Array $cleanDataset array of Word objects
     */
    private function getCleanDataset($dataset): Array {
        $cleanDataset = [];

        foreach($dataset as $word){
            array_push($cleanDataset, new Word($word["word"]));
        }

        return $cleanDataset;
    }
}   
?>