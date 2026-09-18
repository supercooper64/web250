<?php
// asgn04-constructors/constructor.php

class Bird {
    public $commonName;
    public $latinName;

    // Basic constructor requiring both arguments
    public function __construct($commonName, $latinName) {
        $this->commonName = $commonName;
        $this->latinName = $latinName;
    }
}

// Create two new instances of the Bird class
$bird1 = new Bird('Robin', 'Turdus migratorius');
$bird2 = new Bird('Eastern Towhee', 'Pipilo erythrophthalmus');

// Output the results
echo "Common name: " . $bird1->commonName . "<br>";
echo "Latin name: " . $bird1->latinName . "<br>";
echo "------------------------------------<br>";
echo "Common name: " . $bird2->commonName . "<br>";
echo "Latin name: " . $bird2->latinName . "<br>";
