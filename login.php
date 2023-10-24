<?php
session_start();
include_once 'User.php';

$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $user->login($username, $password);

    if ($result) {
        $_SESSION['username'] = $result['username'];
        $_SESSION['role'] = $user->getRole($username);
        header("Location: dashboard.php");
    } else {
        $error_message = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <?php if (isset($error_message)) { echo $error_message; } ?>
</body>
</html>
