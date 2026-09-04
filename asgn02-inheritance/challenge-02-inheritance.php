<?php

class Instrument {

    public $name;
    public $family;

    public function __construct($name, $family) {
        $this->name = $name;
        $this->family = $family;
    }

    public function describe() {
        return "{$this->name} belongs to the {$this->family} family.";
    }
}

class Guitar extends Instrument {

    public $strings = 6;

    public function play() {
        return "The guitar is being strummed.";
    }
}

class Piano extends Instrument {

    public $keys = 88;

    public function play() {
        return "The piano is being played.";
    }
}

// Demonstrate inheritance

$guitar = new Guitar("Acoustic Guitar", "String");
$piano = new Piano("Grand Piano", "Keyboard");

echo "<h2>Inheritance Challenge</h2>";

echo $guitar->describe() . "<br>";
echo $guitar->play() . "<br>";
echo "Strings: " . $guitar->strings . "<br><br>";

echo $piano->describe() . "<br>";
echo $piano->play() . "<br>";
echo "Keys: " . $piano->keys . "<br>";
?>