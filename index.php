<?php
require_once __DIR__. '/backend.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $_ENV['PUBLIC_KEY_V3']?>"></script>
    <title>Home</title>
    <style>
        #carousel {
        width: 400px;
        height: 250px;
        overflow: hidden;
        text-align: center;
        }
        #carousel img {
        width: 100%;
        height: 100%;
        display: none;
        }
        #carousel img.active {
        display: block;
        }
    </style>
</head>
<body>
    <nav>
        <a href="/simple-crud/index.php">Home</a>
        <a href="src/about.php">About</a>
        <a href="src/signup.php">Sign Up</a>
        <a href="src/login.php">Login</a>
        <a href="src/reset.php">Reset</a>
    </nav>

    <h1>Welcome to InnovateTech Solutions</h1>
    <p>Transforming ideas into reality with cutting-edge technology.</p>
    
    <h2>Our Products</h2>
    <div id="carousel">
        <img src="img/1.jpg" class="active">
        <img src="img/2.jpg">
        <img src="img/3.jpg">
    </div>

    <div class="controls">
        <button id="controls-previus" onclick="prev()">Previus</button>
        <button id="controls-next" onclick="next()">Next</button>
    </div>

    <ul>
        <li>AI Analytics Platform: Unlock powerful insights for your business.</li>
        <li>CloudSync Pro: Seamless and secure cloud data management.</li>
        <li>SmartSuite: All-in-one productivity tools for modern teams.</li>
    </ul>

    <h2>About Us</h2>
    <p>Founded in 2020, InnovateTech Solutions delivers innovative software and AI-driven solutions to empower businesses worldwide.</p>
    <p><a href="about.html">Learn more about us</a></p>

    <h2>Contact</h2>
    <p>Email: contact@innovatetech.com</p>
    <p>Phone: (123) 456-7890</p>

    <footer>
        <a href="https://instagram.com">Instagram</a>
        <a href="https://facebook.com">Facebook</a>
        <a href="https://x.com">Twitter</a>
        <a href="https://youtube.com">Youtube</a>
        </footer>
    </body>
<script>
    let index = 0;
    const imagens = document.querySelectorAll("#carousel img");

    function showImage(i) {
      imagens.forEach(img => img.classList.remove("active"));
      imagens[i].classList.add("active");
    }

    function next() {
      index = (index + 1) % imagens.length;
      showImage(index);
    }

    function prev() {
      index = (index - 1 + imagens.length) % imagens.length;
      showImage(index);
    }
  </script>
</html>