<?php
require_once 'envloader.php';

try {
    EnvLoader::load(__DIR__ . '/.env');

    $pdo = new PDO(
        'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME') . ';charset=utf8mb4',
        getenv('DB_USER'),
        getenv('DB_PASS'),
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_TIMEOUT => 5
        ]
    );

} catch (Exception $e) {
    error_log("[" . date('Y-m-d H:i:s') . "] Error: " . $e->getMessage());
    header('HTTP/1.1 503 Service Unavailable');
    die(json_encode(['error' => 'System configuration error: ' . $e->getMessage()]));
} catch (PDOException $e) {
    error_log("[" . date('Y-m-d H:i:s') . "] Database connection failed: " . $e->getMessage());
    header('HTTP/1.1 503 Service Unavailable');
    die(json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]));
}
?>


