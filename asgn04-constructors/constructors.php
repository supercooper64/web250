<?php

class Bird {
    // 1. Static property to track total instances created
    public static $instance_count = 0;

    // 2. Public properties for the instances
    public $commonName;
    public $latinName;

    // 3. Constructor using array arguments and null coalescing
    public function __construct($args = []) {
        $this->commonName = $args['commonName'] ?? NULL;
        $this->latinName = $args['latinName'] ?? NULL;

        // 4. Increment the static tracker using 'self::' just like Sofa
        self::$instance_count++;
    }
}

// Create your bird instances using associative arrays
$bird1 = new Bird([
    'commonName' => 'Acadian Flycatcher', 
    'latinName' => 'Empidonax virescens'
]);

$bird2 = new Bird([
    'commonName' => 'Eastern Towhee', 
    'latinName' => 'Pipilo erythrophthalmus'
]);

// Output the birds
echo "Common name: " . $bird1->commonName . "<br />";
echo "Latin name: " . $bird1->latinName . "<br />";
echo "------------------------------------<br />";
echo "Common name: " . $bird2->commonName . "<br />";
echo "Latin name: " . $bird2->latinName . "<br />";
echo "<br />";

// Display the dynamic total instance count
echo 'Total Birds Created: ' . Bird::$instance_count . '<br />';

?>
