<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/private/initialize.php';

require_login();

$error_message = '';

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id) {
    die('Invalid bird ID.');
}

$bird = Bird::find_by_id($id);

if ($bird === null) {
    die('Bird not found.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($bird->delete()) {

        header('Location: birds.php');
        exit;

    } else {

        $error_message =
            'Unable to delete bird record.';
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Delete Bird</title>
</head>
<body>

    <h1>Delete Bird</h1>

    <p>
        <a href="birds.php">Back to Bird Directory</a>
    </p>

    <?php if ($error_message !== ''): ?>
        <p><?= h($error_message) ?></p>
    <?php endif; ?>

    <p>
        Are you sure you want to delete this bird?
    </p>

    <ul>
        <li>
            <strong>ID:</strong>
            <?= (int) $bird->id ?>
        </li>

        <li>
            <strong>Common Name:</strong>
            <?= h($bird->common_name) ?>
        </li>

        <li>
            <strong>Scientific Name:</strong>
            <?= h($bird->scientific_name) ?>
        </li>
    </ul>

    <form method="post">

        <button type="submit">
            Delete Bird
        </button>

    </form>

</body>
</html>