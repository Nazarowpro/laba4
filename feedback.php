<?php
// ==================================================
// feedback.php — обработчик формы обратной связи.
// Сохраняет данные из формы в таблицу feedback в базе.
// ==================================================
session_start();
require 'script.php';

// Принимаем только POST-запрос
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Простая валидация
    if ($name !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && $message !== '') {
        saveFeedback($name, $email, $message);
        $_SESSION['flash'] = '✅ Спасибо! Ваше сообщение сохранено в базе данных.';
    } else {
        $_SESSION['flash'] = '❌ Ошибка: заполните все поля корректно.';
    }
}

// Возвращаем пользователя на главную (Post/Redirect/Get)
header('Location: index.php#feedback');
exit;
