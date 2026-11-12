<?php

declare(strict_types=1);

session_start();

require_once dirname(__DIR__) . '/private/initialize.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $member = Member::find_by_username($username);

    if (
        $member !== null &&
        password_verify($password, $member->password_hash)
    ) {

        $_SESSION['member_id'] = $member->id;
        $_SESSION['username'] = $member->username;
        $_SESSION['role'] = $member->role;

        header('Location: birds.php');
        exit;
    }

    $error = 'Invalid username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h1>Login</h1>

<?php if ($error !== '') { ?>
    <p><?= htmlspecialchars($error) ?></p>
<?php } ?>

<form action="login.php" method="post">

    <p>
        <label>Username</label><br>
        <input type="text" name="username">
    </p>

    <p>
        <label>Password</label><br>
        <input type="password" name="password">
    </p>

    <p>
        <input type="submit" value="Login">
    </p>

</form>

<p>
    <a href="register.php">Register</a>
</p>

</body>
</html>