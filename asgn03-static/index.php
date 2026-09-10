<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>asgn03 Static Properties and Methods</title>
</head>
<body>

<h1>Static Properties and Methods</h1>

<?php

include 'Bird.php';

echo "<h2>Instance Counts Before create()</h2>";

echo "<p>Bird: " . Bird::$instance_count . "</p>";
echo "<p>Yellow-bellied Flycatcher: " . YellowBelliedFlyCatcher::$instance_count . "</p>";
echo "<p>Kiwi: " . Kiwi::$instance_count . "</p>";

echo "<hr>";

$bird = Bird::create();
$fly_catcher = YellowBelliedFlyCatcher::create();
$kiwi = Kiwi::create();

echo "<h2>Instance Counts After create()</h2>";

echo "<p>Bird: " . Bird::$instance_count . "</p>";
echo "<p>Yellow-bellied Flycatcher: " . YellowBelliedFlyCatcher::$instance_count . "</p>";
echo "<p>Kiwi: " . Kiwi::$instance_count . "</p>";

echo "<hr>";

echo '<p>The generic song of any bird is "' . $bird->song . '".</p>';

echo '<p>The song of the '
    . $fly_catcher->name
    . ' on breeding grounds is "'
    . $fly_catcher->song
    . '".</p>';

echo "<p>The " . $fly_catcher->name . " " . $fly_catcher->can_fly() . ".</p>";

echo "<p>The " . $kiwi->name . " " . $kiwi->can_fly() . ".</p>";

echo "<hr>";

echo "<p>Bird egg count: " . Bird::$egg_num . "</p>";

echo "<p>Yellow-bellied Flycatcher egg count: "
    . YellowBelliedFlyCatcher::$egg_num
    . "</p>";

?>

</body>
</html>