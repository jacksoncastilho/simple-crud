<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../.env');
$dotenv->load();

require_once __DIR__. '/connection_db.php';

function signup($pdo, $response_data) {
    try {
        $username = $_POST['username'];
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => $username, 'password' => $hashed_password]);

        echo "Registration completed successfully! Score: " . $response_data->score;
    } catch (PDOException $e) {
        echo "Sign Up Failled! Error Message: " . $e->getMessage();
    }
}

function login($pdo, $response_data) {
    try {
        $username = $_POST['username'];

        $stmt = $pdo->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($_POST['password'], $user['password'])) {
            echo "Login successful! Score: " . $response_data->score;
        } else {
            echo "Login failed. Check your credentials! Score: " . $response_data->score;
        }
    } catch (PDOException $e) {
        echo "Sign Up Failled! Error Message: " . $e->getMessage();
    }
}

function resetdb($pdo) {
    try {
        $pdo->exec("TRUNCATE TABLE users RESTART IDENTITY;");
        echo "Database reset successfully! " . date('Y-m-d H:i:s');
    } catch (PDOException $e) {
        die("Error resetting database: " . htmlspecialchars($e->getMessage()));
    }
}

if($_POST) {
    $recaptcha_secret = $_ENV['PRIVATE_KEY_V3'];
    $recaptcha_response = $_POST['g-recaptcha-response'];

    if (!empty($_POST['honeypot'])) {
        die('Bot detected by honeypot.');
    }

    $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$recaptcha_secret.'&response='.$recaptcha_response);
    $response_data = json_decode($response);
    
    if ($response_data->success && $response_data->score >= 0.5) {
        if ($response_data->action === 'signup_form') {
            signup($pdo, $response_data);
        } else if ($response_data->action === 'login_form') {
            login($pdo, $response_data);
        } else if ($response_data->action === 'reset_form') {
            resetdb($pdo);
        }
    } else {
        echo "Possible bot! Score: " . ($response_data->score ?? 'N/A');
    }
}
