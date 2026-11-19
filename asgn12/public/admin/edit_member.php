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

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $member->first_name =
        trim($_POST['first_name'] ?? '');

    $member->last_name =
        trim($_POST['last_name'] ?? '');

    $member->email =
        trim($_POST['email'] ?? '');

    $member->username =
        trim($_POST['username'] ?? '');

    $member->role =
        $_POST['role'] ?? 'member';

    if (
        $member->first_name === ''
        || $member->last_name === ''
        || $member->email === ''
        || $member->username === ''
    ) {
        $error = 'All fields are required.';
    } elseif ($member->update()) {

        header('Location: members.php');
        exit;
    } else {
        $error = 'Unable to save changes.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Member</title>
</head>
<body>

<h1>Edit Member</h1>

<p>
    <a href="members.php">
        Back to Members
    </a>
</p>

<?php if ($error !== '') { ?>

    <p>
        <?php print $error; ?>
    </p>

<?php } ?>

<form method="post">

    <p>
        First Name<br>
        <input
            type="text"
            name="first_name"
            value="<?php print htmlspecialchars($member->first_name); ?>"
            required
        >
    </p>

    <p>
        Last Name<br>
        <input
            type="text"
            name="last_name"
            value="<?php print htmlspecialchars($member->last_name); ?>"
            required
        >
    </p>

    <p>
        Email<br>
        <input
            type="email"
            name="email"
            value="<?php print htmlspecialchars($member->email); ?>"
            required
        >
    </p>

    <p>
        Username<br>
        <input
            type="text"
            name="username"
            value="<?php print htmlspecialchars($member->username); ?>"
            required
        >
    </p>

    <p>
        Role<br>

        <select name="role">

            <option
                value="member"
                <?php if ($member->role === 'member') { print 'selected'; } ?>
            >
                member
            </option>

            <option
                value="admin"
                <?php if ($member->role === 'admin') { print 'selected'; } ?>
            >
                admin
            </option>

        </select>

    </p>

    <p>
        <button type="submit">
            Save Changes
        </button>
    </p>

</form>

</body>
</html>