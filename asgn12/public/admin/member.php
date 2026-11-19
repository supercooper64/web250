<?php

declare(strict_types=1);

require_once '../../private/initialize.php';

require_admin(); 

$admin_nav = true;

require __DIR__ . '/../nav.php';

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if ($id === null || $id === false) {
    http_response_code(400);
    exit('Invalid member ID.');
}

$member = Member::find_by_id($id);

if ($member === null) {
    http_response_code(404);
    exit('Member not found.');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Member Details</title>
</head>
<body>

<h1>Member Details</h1>

<p>
    <a href="members.php">Back to Members</a>
</p>

<p>
    <strong>ID:</strong>
    <?php print $member->id; ?>
</p>

<p>
    <strong>First Name:</strong>
    <?php print $member->first_name; ?>
</p>

<p>
    <strong>Last Name:</strong>
    <?php print $member->last_name; ?>
</p>

<p>
    <strong>Email:</strong>
    <?php print $member->email; ?>
</p>

<p>
    <strong>Username:</strong>
    <?php print $member->username; ?>
</p>

<p>
    <strong>Role:</strong>
    <?php print $member->role; ?>
</p>

</body>
</html>