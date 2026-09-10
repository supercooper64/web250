<?php

class Bird {
    public static $instance_count = 0;
    public static $egg_num = 0;
    
    var $habitat;
    var $food;
    var $nesting = "tree";
    var $conservation;
    var $song = "chirp";
    static $flying = "yes";

    public function __construct() {
        static::$instance_count++;
    }

    public static function create() {
        return new static();
    }

    // Fixed to match requested string spacing and phrasing exactly
    function can_fly() {
        $flying_string = (static::$flying == "yes") ? "bird can fly" : " cannot fly and it stuck on the ground";
        return $flying_string;
    }
}

class YellowBelliedFlyCatcher extends Bird {
    // Added to prevent flycatcher count from bleeding into the base Bird class
    public static $instance_count = 0; 
    public static $egg_num = "3-4, sometimes 5.";
    
    var $name = "yellow-bellied flycatcher";
    var $diet = "mostly insects.";
    var $song = "flat chilk";
}

class Kiwi extends Bird {
    // Added to prevent kiwi count from bleeding into the base Bird class
    public static $instance_count = 0;
    static $flying = "no";
    
    var $name = "kiwi";
    var $diet = "omnivorous";
}
?>
