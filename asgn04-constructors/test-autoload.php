<?php
// asgn04-constructors/test-autoload.php

// 1. Require autoload.php
require_once 'autoload.php';

// 2. Create a new Bird object using the data array
$flycatcher = new Bird([
    'commonName' => 'Acadian Flycatcher',
    'latinName' => 'Empidonax virescens'
]);

// 3. Display the description using the class method
echo $flycatcher->description();
