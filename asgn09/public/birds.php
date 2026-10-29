<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/private/initialize.php';

$birds = Bird::find_all();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bird Directory</title>
</head>
<body>
    <h1>Bird Directory</h1>

    <p><a href="index.php">Back to index</a></p>

    <p><a href="bird_new.php">Create Bird</a></p>

    <?php if ($birds === []): ?>
        <p>No birds were found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th scope="col">Common Name</th>
                    <th scope="col">Scientific Name</th>
                    <th scope="col">Primary Habitat</th>
                    <th scope="col">Seasonal Status</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($birds as $bird): ?>
                    <tr>
                        <td><?= h($bird->common_name) ?></td>
                        <td><em><?= h($bird->scientific_name) ?></em></td>
                        <td><?= h($bird->primary_habitat) ?></td>
                        <td><?= h($bird->seasonal_status) ?></td>
                        <td><a href="bird.php?id=<?= (int) $bird->id ?>">View details</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
