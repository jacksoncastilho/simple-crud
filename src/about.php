<?php
require_once __DIR__. '/backend.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $_ENV['PUBLIC_KEY_V3']?>"></script>
    <title>About</title>
</head>
<body>
    <nav>
        <a href="/simple-crud/index.php">Home</a>
        <a href="about.php">About</a>
        <a href="signup.php">Sign Up</a>
        <a href="login.php">Login</a>
        <a href="reset.php">Reset</a>
    </nav>
    <h1>About Us</h1>
    <hr>
    <p>Welcome to <strong>InnovateTech Solutions</strong>, a forward-thinking technology company dedicated to transforming ideas into reality. Founded in 2020, we specialize in delivering cutting-edge software development, AI-driven solutions, and digital transformation services to businesses worldwide.</p>
    <p>Our mission is to empower organizations with innovative tools and strategies that drive growth, efficiency, and success. With a team of passionate engineers, designers, and strategists, we pride ourselves on creating tailored solutions that meet the unique needs of our clients.</p>
    <p>At InnovateTech, we value creativity, collaboration, and excellence. Whether you're a startup looking to disrupt the market or an established enterprise seeking to optimize operations, we're here to help you navigate the ever-evolving tech landscape.</p>
    <p>Join us on this journey to shape the future, one innovation at a time.</p>
</body>
</html>