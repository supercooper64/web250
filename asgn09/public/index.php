<?php

declare(strict_types=1);

$bird_count = 0;
$image_count = 0;
$link_count = 0;
$error_message = '';

try {
    require_once dirname(__DIR__) . '/private/initialize.php';

    $bird_count = Bird::count_all();
    $image_count = (int) $pdo->query('SELECT COUNT(*) FROM bird_images')->fetchColumn();
    $link_count = (int) $pdo->query('SELECT COUNT(*) FROM bird_image_links')->fetchColumn();
} catch (Throwable $error) {
    $error_message = 'The database summary is not available right now.';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>WEB 250 asgn09 - WNC Birds</title>
</head>
<body>
    <h1>WEB 250 asgn09 - WNC Birds</h1>

    <p><a href="birds.php">Bird Directory</a></p>

    <?php if ($error_message !== ''): ?>
        <p><?= h($error_message) ?></p>
    <?php else: ?>
        <table>
            <caption>Database Summary</caption>
            <thead>
                <tr>
                    <th scope="col">Table</th>
                    <th scope="col">Rows</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>birds</td><td><?= $bird_count ?></td></tr>
                <tr><td>bird_images</td><td><?= $image_count ?></td></tr>
                <tr><td>bird_image_links</td><td><?= $link_count ?></td></tr>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
