<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/private/initialize.php';

$database = Database::connect();

Bird::set_database($database);

$birds = Bird::find_all();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>WNC Bird Directory</title>
</head>
<body>

    <h1>WNC Bird Directory</h1>

    <?php if (count($birds) === 0): ?>

        <p>No birds were found.</p>

    <?php else: ?>

        <table border="1">
            <tr>
                <th scope="col">Common Name</th>
                <th scope="col">Scientific Name</th>
                <th scope="col">Primary Habitat</th>
                <th scope="col">Seasonal Status</th>
                <th scope="col">Details</th>
            </tr>

            <?php foreach ($birds as $bird): ?>

                <tr>
                    <td><?= h($bird->common_name) ?></td>

                    <td><?= h($bird->scientific_name) ?></td>

                    <td><?= h($bird->primary_habitat) ?></td>

                    <td><?= h($bird->seasonal_status) ?></td>

                  <td>
    <a href="bird.php?id=<?= (int)$bird->id ?>">
        View Details
    </a>
</td>
                </tr>

            <?php endforeach; ?>

        </table>

    <?php endif; ?>

    <p>
        <a href="index.php">Back to Home</a>
    </p>

</body>
</html>