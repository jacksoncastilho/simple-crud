<?php
require_once __DIR__. '/backend.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $_ENV['PUBLIC_KEY_V3']?>"></script>
    <title>Document</title>
    
    <script> window.env = {PUBLIC_KEY_V3: "<?php echo $_ENV['PUBLIC_KEY_V3']; ?>"}</script>
</head>
<body>
    <nav>
        <a href="/simple-crud/index.php">Home</a>
        <a href="about.php">About</a>
        <a href="signup.php">Sign Up</a>
        <a href="login.php">Login</a>
        <a href="reset.php">Reset</a>
    </nav>
    <h1>Reset</h1>
    <hr>
    <p>This action is intended to reset the entire database.</p>
    <form method="post" id="reset-form">
        <button id="submit" type="submit">Reset</button>
        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
    </form>
    <div id="message"></div>
</body>
<script src="/simple-crud/js/script.js"></script>
</html>