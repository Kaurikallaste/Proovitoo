<?php
namespace Proovitoo\Models;

class Word {
    private $word;
    private $chars;

    function __construct($word) {
        $this->word = trim($word);
        $this->chars = $this->allCharactersSorted();
    }

    /**
     * Sorts all characters of Word->word
     * 
     * @return string
     */
    private function allCharactersSorted(): string {
        $chars = str_split(strtolower($this->word));
        sort($chars);
        return trim(implode($chars));
    }

    /**
     * @return $word
     */
    public function getWord(): string {
        return $this->word;
    }

    /**
     * @return $chars
     */
    public function getChars(): string {
        return $this->chars;
    }
}
?>