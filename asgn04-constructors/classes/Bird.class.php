<?php
// asgn04-constructors/classes/Bird.class.php

class Bird {
    public $commonName;
    public $latinName;

    public function __construct($args = []) {
        $this->commonName = $args['commonName'] ?? 'Unknown';
        $this->latinName = $args['latinName'] ?? 'Unknown';
    }

    // This method returns the formatted text required for step 2
    public function description() {
        return "Common name: " . $this->commonName . "<br>Latin name: " . $this->latinName . "<br>";
    }
}
