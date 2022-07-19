<?php
class User {
    private $id;
    private $name;

    function __construct($name, $id) {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * @return $name
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return $id
     */
    public function getId(): int {
        return $this->id;
    }
}
?>