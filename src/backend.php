<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../.env');
$dotenv->load();

require_once __DIR__. '/connection_db.php';

function signup($pdo) {
    try {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => $username, 'password' => $password]);

        echo "Registration completed successfully!";
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

        if ($user && $_POST['password'] == $user['password']) {
            echo "Login successful!";
        } else {
            echo "Login failed. Check your credentials!";
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
    if ($_GET['form'] == "signup-form") {
        signup($pdo, $response_data);
    } else if ($_GET['form'] == "login-form") {
        login($pdo, $response_data);
    } else if ($_GET['form'] == "reset-form") {
        resetdb($pdo);
    }
}
