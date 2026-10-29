<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/private/initialize.php';

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 1]]
);

$bird = null;
$message = '';

if ($id === null || $id === false) {
    http_response_code(400);
    $message = 'Please provide a valid bird ID.';
} else {
    $bird = Bird::find_by_id($id);

    if ($bird === null) {
        http_response_code(404);
        $message = 'Bird not found.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bird Details</title>
</head>
<body>
    <p><a href="birds.php">Back to bird directory</a></p>

    <?php if ($bird === null): ?>
        <h1>Bird Details</h1>
        <p><?= h($message) ?></p>
    <?php else: ?>
        <h1><?= h($bird->common_name) ?></h1>
        <dl>
            <dt>Record ID</dt>
            <dd><?= (int) $bird->id ?></dd>

            <dt>Scientific Name</dt>
            <dd><em><?= h($bird->scientific_name) ?></em></dd>

            <dt>Family</dt>
            <dd><?= h($bird->family_name) ?></dd>

            <dt>Primary Habitat</dt>
            <dd><?= h($bird->primary_habitat) ?></dd>

            <dt>Seasonal Status</dt>
            <dd><?= h($bird->seasonal_status) ?></dd>

            <dt>Description</dt>
            <dd><?= h($bird->description) ?></dd>
        </dl>
    <?php endif; ?>
</body>
</html>
