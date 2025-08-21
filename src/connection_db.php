<?php
$host = $_ENV['PG_HOST'];
$port = $_ENV['PG_PORT'];
$dbname = $_ENV['PG_DBNAME'];
$user = $_ENV['PG_USERNAME'];
$password = $_ENV['PG_PASSWORD'];

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}