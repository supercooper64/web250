<?php

declare(strict_types=1);

require_once('../private/initialize.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($first_name === '') {
        $errors[] = 'First name is required.';
    }

    if ($last_name === '') {
        $errors[] = 'Last name is required.';
    }

    if ($email === '') {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is not valid.';
    }

    if ($username === '') {
        $errors[] = 'Username is required.';
    }

    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters.';
    }

    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    if (Member::find_by_username($username) !== null) {
        $errors[] = 'Username already exists.';
    }

    if (Member::find_by_email($email) !== null) {
        $errors[] = 'Email already exists.';
    }

    if (empty($errors)) {

        $member = new Member();

        $member->first_name = $first_name;
        $member->last_name = $last_name;
        $member->email = $email;
        $member->username = $username;
        $member->password_hash =
            password_hash($password, PASSWORD_DEFAULT);

        if ($member->create()) {

            header('Location: login.php');
            exit;
        }

        $errors[] = 'Unable to register member.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>

<h1>Member Registration</h1>

<?php if (!empty($errors)) { ?>
    <ul>
        <?php foreach ($errors as $error) { ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form action="register.php" method="post">

    <p>
        <label>First Name</label><br>
        <input type="text" name="first_name">
    </p>

    <p>
        <label>Last Name</label><br>
        <input type="text" name="last_name">
    </p>

    <p>
        <label>Email</label><br>
        <input type="email" name="email">
    </p>

    <p>
        <label>Username</label><br>
        <input type="text" name="username">
    </p>

    <p>
        <label>Password</label><br>
        <input type="password" name="password">
    </p>

    <p>
        <label>Confirm Password</label><br>
        <input type="password" name="confirm_password">
    </p>

    <p>
        <input type="submit" value="Register">
    </p>

</form>

<p>
    <a href="birds.php">Back to Birds</a>
</p>

</body>
</html>