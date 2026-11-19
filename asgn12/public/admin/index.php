<?php

declare(strict_types=1);

require_once '../../private/initialize.php';

require_admin(); 

$admin_nav = true;

require __DIR__ . '/../nav.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin</title>
</head>
<body>

<h1>Administration</h1>

<ul>
    <li>
        <a href="members.php">
            Manage Members
        </a>
    </li>

    <li>
        <a href="../birds.php">
            View Birds
        </a>
    </li>

    <li>
        <a href="../index.php">
            Home
        </a>
    </li>
</ul>

</body>
</html>