<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/private/initialize.php';

$bird = new Bird();
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $bird->common_name = trim($_POST['common_name'] ?? '');
    $bird->scientific_name = trim($_POST['scientific_name'] ?? '');
    $bird->family_name = trim($_POST['family_name'] ?? '');
    $bird->primary_habitat = trim($_POST['primary_habitat'] ?? '');
    $bird->seasonal_status = trim($_POST['seasonal_status'] ?? '');
    $bird->description = trim($_POST['description'] ?? '');

    if (
        $bird->common_name === '' ||
        $bird->scientific_name === ''
    ) {

        $error_message =
            'Common name and scientific name are required.';

    } else {

        if ($bird->create()) {

            header('Location: birds.php');
            exit;

        } else {

            $error_message =
                'Unable to create bird record.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create Bird</title>
</head>
<body>
    <h1>Create Bird</h1>

    <p><a href="birds.php">Back to bird directory</a></p>

    <?php if ($error_message !== ''): ?>
        <p><?= h($error_message) ?></p>
    <?php endif; ?>

    <form method="post" action="bird_new.php">
        <p>
            <label for="common_name">Common name</label><br>
            <input
                type="text"
                id="common_name"
                name="common_name"
                value="<?= h($bird->common_name) ?>"
                required
            >
        </p>

        <p>
            <label for="scientific_name">Scientific name</label><br>
            <input
                type="text"
                id="scientific_name"
                name="scientific_name"
                value="<?= h($bird->scientific_name) ?>"
                required
            >
        </p>

        <p>
            <label for="family_name">Family name</label><br>
            <input
                type="text"
                id="family_name"
                name="family_name"
                value="<?= h($bird->family_name) ?>"
            >
        </p>

        <p>
            <label for="primary_habitat">Primary habitat</label><br>
            <input
                type="text"
                id="primary_habitat"
                name="primary_habitat"
                value="<?= h($bird->primary_habitat) ?>"
            >
        </p>

        <p>
            <label for="seasonal_status">Seasonal status</label><br>
            <input
                type="text"
                id="seasonal_status"
                name="seasonal_status"
                value="<?= h($bird->seasonal_status) ?>"
            >
        </p>

        <p>
            <label for="description">Description</label><br>
            <textarea id="description" name="description" rows="5" cols="50"><?= h($bird->description) ?></textarea>
        </p>

        <p>
            <button type="submit">Create Bird</button>
        </p>
    </form>
</body>
</html>
