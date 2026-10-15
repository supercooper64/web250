<?php

declare(strict_types=1);
header('Content-Type: text/plain; charset=UTF-8');

// EXERCISE 01: Place a breakpoint on the += line.
// Record $observations before and after Step Over using Variables + Watch.
$birdName = 'Carolina Wren';
$habitat = 'Thickets';
$observations = 3;

$observations += 2;

print "Bird: {$birdName}\n";
print "Habitat: {$habitat}\n";
print "Sightings: {$observations}\n";
