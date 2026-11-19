<?php

declare(strict_types=1);

require_once '../../private/initialize.php';

require_admin(); 

$admin_nav = true;

require __DIR__ . '/../nav.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'member';

    if (
        $first_name === ''
        || $last_name === ''
        || $email === ''
        || $username === ''
        || $password === ''
    ) {
        $error = 'All fields are required.';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters.';
    } elseif (Member::find_by_username($username) !== null) {
        $error = 'Username already exists.';
    } elseif (Member::find_by_email($email) !== null) {
        $error = 'Email already exists.';
    } else {

        $member = new Member();

        $member->first_name = $first_name;
        $member->last_name = $last_name;
        $member->email = $email;
        $member->username = $username;
        $member->password_hash =
            password_hash(
                $password,
                PASSWORD_DEFAULT
            );
        $member->role = $role;

        if ($member->create()) {

            header('Location: members.php');
            exit;
        }

        $error = 'Unable to create member.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create Member</title>
</head>
<body>

<h1>Create Member</h1>

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
            required
        >
    </p>

    <p>
        Last Name<br>
        <input
            type="text"
            name="last_name"
            required
        >
    </p>

    <p>
        Email<br>
        <input
            type="email"
            name="email"
            required
        >
    </p>

    <p>
        Username<br>
        <input
            type="text"
            name="username"
            required
        >
    </p>

    <p>
        Password<br>
        <input
            type="password"
            name="password"
            required
        >
    </p>

    <p>
        Role<br>

        <select name="role">

            <option value="member">
                member
            </option>

            <option value="admin">
                admin
            </option>

        </select>

    </p>

    <p>
        <button type="submit">
            Create Member
        </button>
    </p>

</form>

</body>
</html>