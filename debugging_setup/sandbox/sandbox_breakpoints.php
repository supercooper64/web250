<?php

declare(strict_types=1);
header('Content-Type: text/plain; charset=UTF-8');

/**
 * GUIDED SANDBOX — complete working example.
 * First try running it in your browser, then try pausing before the addition.
 * This script does not connect to a database.
 */
$bird = 'Carolina Wren';
$today = 2;
$yesterday = 3;
$total = 0;

// 🔴 Place a breakpoint here. PHP pauses BEFORE this line executes.
$total = $today + $yesterday;

// Press Step Over to execute the line above and inspect $total (= 5).
print "Bird: {$bird}\n";
print "Total sightings: {$total}\n";
