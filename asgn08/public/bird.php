<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/private/initialize.php';

$database = Database::connect();
Bird::set_database($database);

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if ($id === false || $id < 1) {
    http_response_code(400);
    exit('Invalid bird ID.');
}

$bird = Bird::find_by_id($id);

if ($bird === null) {
    http_response_code(404);
    exit('Bird not found.');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bird Details</title>
</head>
<body>

    <h1>Bird Details</h1>

    <p><strong>ID:</strong> <?= $bird->id ?></p>

    <p>
        <strong>Common Name:</strong>
        <?= h($bird->common_name) ?>
    </p>

    <p>
        <strong>Scientific Name:</strong>
        <?= h($bird->scientific_name) ?>
    </p>

    <p>
        <strong>Family Name:</strong>
        <?= h($bird->family_name) ?>
    </p>

    <p>
        <strong>Primary Habitat:</strong>
        <?= h($bird->primary_habitat) ?>
    </p>

    <p>
        <strong>Seasonal Status:</strong>
        <?= h($bird->seasonal_status) ?>
    </p>

    <p>
        <strong