<?php
require_once __DIR__. '/backend.php';

$aloadRecaptcha = loadRecaptcha();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $aloadRecaptcha["scriptRecaptcha"] ?? ""?>
    <title>Document</title>
    <style>
        #submit {
            margin-top: 5px;
        }
    </style>
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
        <?php echo $aloadRecaptcha["divRecaptchaV2"] ?? ""?>
        <button id="submit" type="submit">Reset</button>
    </form>
    <div id="message"></div>
</body>
<script src="/simple-crud/js/script.js"></script>
</html>