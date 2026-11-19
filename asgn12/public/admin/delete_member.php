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

/*
 * Prevent admin from deleting own account.
 */
$current_member = current_member();

if (
    $current_member !== null
    && $current_member->id === $member->id
) {
    exit('You cannot delete your own account.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($member->delete()) {

        header('Location: members.php');
        exit;
    }

    exit('Unable to delete member.');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Delete Member</title>
</head>
<body>

<h1>Delete Member</h1>

<p>
    <a href="members.php">
        Cancel
    </a>
</p>

<p>
    Are you sure you want to delete this member?
</p>

<ul>

    <li>
        ID:
        <?php print $member->id; ?>
    </li>

    <li>
        Name:
        <?php
        print h(
            $member->first_name .
            ' ' .
            $member->last_name
        );
        ?>
    </li>

    <li>
        Username:
        <?php print h($member->username); ?>
    </li>

    <li>
        Email:
        <?php print h($member->email); ?>
    </li>

    <li>
        Role:
        <?php print h($member->role); ?>
    </li>

</ul>

<form method="post">

    <button type="submit">
        Delete Member
    </button>

</form>

</body>
</html>
