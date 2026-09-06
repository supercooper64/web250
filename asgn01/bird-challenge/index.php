<?php 

class Bird {
  var $commonName;
  var $food = "bugs";
  var $nestPlacement = "tree";
  var $conservationLevel;
  var $song;
  var $fly;
  
  function song($soundsLike) {
    $this->song = $soundsLike;
  }

  function canFly() {
    if($this->fly) {
      return "This bird can fly.";
    } else
      return "This bird cannot fly.";
  }
}

//Create an instance
$bird1 = new Bird;
$bird2 = new Bird;

$birds = [$bird1, $bird2];

// bird1
$bird1->commonName = "Eastern Towhee";
$bird1->food = "seeds, fruits, insects, spiders";
$bird1->nestPlacement = "ground";
$bird1->conservationLevel = "low";
$bird1->fly = "true";
$bird1->song("drink-your-tea!");


//bird2
$bird2->commonName = "Indigo Bunting";
$bird2->food = "small seeds, berries, buds, insects";
$bird2->nestPlacement = "roadsides, railroad rights-of-way, fields";
$bird2-> conservationLevel = "low";
$bird2->fly = "true";
$bird2->song("whatwhat!!");


//Display bird content
foreach($birds as $bird) {
  echo "Name: " . $bird->commonName . "<br>";
  echo "Food: " . $bird->food . "<br>";
  echo "Nest Location: " . $bird->nestPlacement . "<br>";
  echo "Conservation Level: " . $bird->conservationLevel . "<br>";
  echo "Bird Song: " . $bird->song . "<br>";
  echo "Flying ability: " . $bird->canFly() . "<br><br>";
}