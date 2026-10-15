<?php

declare(strict_types=1);
header('Content-Type: text/plain; charset=UTF-8');

// EXERCISE 03: Step Into the two functions; inspect the Call Stack.
function formatObservation(string $name, int $count): string
{
    $word = ($count === 1) ? 'sighting' : 'sightings';
    return "{$name}: {$count} {$word}";
}

function describeBird(string $name, int $count): string
{
    $report = formatObservation($name, $count);
    return $report;
}

// Put your first breakpoint here, then Step Into.
$report = describeBird('Eastern Towhee', 2);
print "{$report}\n";
