<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../.env');
$dotenv->load();

require_once __DIR__. '/connection_db.php';

function signup($pdo) {
    if (recaptchaV2() && recaptchaV3()) {
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
    } else {
        echo json_encode(array("success"=> false, "message"=> "Action failed because a bot was detected!"));
    }
}

function login($pdo) {
    if (recaptchaV2() && recaptchaV3()) {
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
    } else {
        echo json_encode(array("success"=> false, "message"=> "Action failed because a bot was detected!"));
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

function recaptchaV2() {
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $recaptcha_secret = $_ENV['PRIVATE_KEY_V2'];
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $responseV2 = file_get_contents($url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);

    return json_decode($responseV2)->success;
}

function recaptchaV3() {
    $aHeaders = getallheaders();

    $url = "https://www.google.com/recaptcha/api/siteverify";
    $recaptcha_secret = $_ENV['PRIVATE_KEY_V3'];
    $grResponse = $aHeaders['gr-response'];

    $responseV3 = file_get_contents($url . '?secret=' . $recaptcha_secret . '&response=' . $grResponse);

    return json_decode($responseV3)->success && json_decode($responseV3)->score >= $_ENV['SCORE_V3'];
}

if ($_GET['form']) {
    $form = $_GET['form'];

    if ($form == "signup-form") {
        signup($pdo);
    } else if ($form == "login-form") {
        login($pdo);
    } else if ($form == "reset-form") {
        resetdb($pdo);
    }
}