<?php
// ==================================================
// script.php
// Подключение к базе данных и выгрузка данных.
// Подключается на страницах сайта: require 'script.php';
// ==================================================

// --- Параметры подключения (настрой под себя) ---
const DB_HOST = '127.0.0.1';
const DB_NAME = 'techshop';
const DB_USER = 'techshop';
const DB_PASS = '12345'; // в OpenServer пароль root обычно пустой

/**
 * Функция подключения к базе данных.
 * Возвращает объект PDO (единое подключение на весь запрос).
 */
function getDB(): PDO
{
    static $pdo = null; // static — соединение создаётся один раз

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
    return $pdo;
}

/**
 * Выгрузка товаров для отображения на сайте.
 */
function getProducts(): array
{
    $stmt = getDB()->query('SELECT * FROM products ORDER BY id');
    return $stmt->fetchAll();
}

/**
 * Выгрузка данных из формы обратной связи.
 */
function getFeedbacks(): array
{
    $stmt = getDB()->query('SELECT * FROM feedback ORDER BY created_at DESC');
    return $stmt->fetchAll();
}

/**
 * Сохранение данных, переданных из формы обратной связи, в базу.
 */
function saveFeedback(string $name, string $email, string $message): bool
{
    $stmt = getDB()->prepare(
        'INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)'
    );
    return $stmt->execute([$name, $email, $message]);
}
