<?php
/**
 * Возвращает экземпляр PDO для подключения к базе данных.
 *
 * @return PDO
 */
function getPDO() {
    
    $config = require __DIR__ . '/../config/db.php';

    
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";

    try {
        
        $pdo = new PDO($dsn, $config['user'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,           // выбрасывать исключения при ошибках
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,      // по умолчанию возвращать ассоциативные массивы
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }
}
