<?php
require_once __DIR__. '/backend.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $_ENV['PUBLIC_KEY_V3']?>"></script>
    <title>Sign Up</title>

    <script> window.env = {PUBLIC_KEY_V3: "<?php echo $_ENV['PUBLIC_KEY_V3']; ?>"}</script>
</head>
<style>
    input {
        display: block;
        margin-bottom: 5px;
    }
</style>
<body>
    <nav>
        <a href="/simple-crud/index.php">Home</a>
        <a href="about.php">About</a>
        <a href="signup.php">Sign Up</a>
        <a href="login.php">Login</a>
        <a href="reset.php">Reset</a>
    </nav>
    <h1>Sign Up</h1>
    <hr>
    <form method="post" id="signup-form">
        <input type="text" name="username" id="username" placeholder="Username">
        <input type="password" name="password" id="password" placeholder="Password">
        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm your password">
        <button id="submit" type="submit">Sign Up</button>
        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
    </form>
    <div id="message"></div>
</body>
<script src="/simple-crud/js/script.js"></script>
</html>