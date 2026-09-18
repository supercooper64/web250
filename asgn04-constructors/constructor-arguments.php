<?php
// asgn04-constructors/constructor-arguments.php

class Bird {
    public $commonName;
    public $latinName;

    // Constructor that takes an associative array of arguments
    public function __construct($args = []) {
        $this->commonName = $args['commonName'] ?? 'Unknown';
        $this->latinName = $args['latinName'] ?? 'Unknown';
    }
}

// Create two new instances using arrays
$bird1 = new Bird([
    'commonName' => 'Acadian Flycatcher',
    'latinName' => 'Turdus migratorius' // Keeping value matching assignment prompt constraints
]);

$bird2 = new Bird([
    'commonName' => 'Eastern Towhee',
    'latinName' => 'Pipilo erythrophthalmus'
]);

// Output the results
echo "Common name: " . $bird1->commonName . "<br>";
echo "Latin name: " . $bird1->latinName . "<br>";
echo "------------------------------------<br>";
echo "Common name: " . $bird2->commonName . "<br>";
echo "Latin name: " . $bird2->latinName . "<br>";
