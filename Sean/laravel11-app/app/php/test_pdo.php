<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=test_laravel11', 'laravel_user', 'laravel11');
    echo "PDO MySQL connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
