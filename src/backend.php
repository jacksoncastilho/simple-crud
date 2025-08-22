<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../.env');
$dotenv->load();

require_once __DIR__. '/connection_db.php';

function signup($pdo) {
    try {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cofirmPassword = $_POST['confirm-password'];

        if ($password == $cofirmPassword) {
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => $password]);
    
            echo json_encode(array("success"=> true, "message"=> "Registration completed successfully!"));
        } else {
            echo json_encode(array("success"=> false, "message"=> "Sign Up Failled! Passwords are not the same"));
        }
    } catch (PDOException $e) {
        echo json_encode(array("success"=> false, "message"=> "Error Message: " . $e->getMessage()));
    }
}

function login($pdo) {
    try {
        $username = $_POST['username'];

        $stmt = $pdo->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && $_POST['password'] == $user['password']) {
            echo json_encode(array("success"=> true, "message"=> "Login successful!"));
        } else {
            echo json_encode(array("success"=> false, "message"=> "Login failed. Check your credentials!"));
        }
    } catch (PDOException $e) {
        echo json_encode(array("success"=> false, "message"=> "Error Message: " . $e->getMessage()));
    }
}

function resetdb($pdo) {
    try {
        $pdo->exec("TRUNCATE TABLE users RESTART IDENTITY;");

        echo json_encode(array("success"=> true, "message"=> "Database reset successfully! " . date('Y-m-d H:i:s')));
    } catch (PDOException $e) {
        echo json_encode(array("success"=> false, "message"=> "Error Message: " . $e->getMessage()));
    }
}

function recaptcha() {
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $recaptcha_secret = $_ENV['PRIVATE_KEY_V3'];
    $recaptcha_response = $_POST['g-recaptcha-response'];

    $response = file_get_contents($url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);

    return json_decode($response);
}

if ($_GET['form']) {
    $form = $_GET['form'];

    $response_data = recaptcha();

    if ($response_data->success && $response_data->score >= 0.5) {
        if ($form == "signup-form") {
            signup($pdo);
        } else if ($form == "login-form") {
            login($pdo);
        } else if ($form == "reset-form") {
            resetdb($pdo);
        }
    } else {
        echo json_encode(array("success"=> false, "message"=> "Action failed because a bot was detected! Score: " . ($response_data->score ?? 'N/A')));
    }
}