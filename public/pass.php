<?php
// pass.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!$login || !$password) {
        echo "Заполните все поля";
        exit;
    }

    $file = 'pass.html';

    // Создаем файл, если не существует, с базовой структурой
    if (!file_exists($file)) {
        file_put_contents($file, "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Users</title></head><body><ul></ul></body></html>");
    }

    $content = file_get_contents($file);

    // Проверяем, есть ли уже такой логин
    if (strpos($content, "Логин: $login |") !== false) {
        echo "Пользователь с таким логином уже зарегистрирован";
        exit;
    }

    // Вставляем новую запись перед </ul>
    $newEntry = "<li>Логин: $login | Пароль: $password</li>\n";

    $content = str_replace("</ul>", $newEntry . "</ul>", $content);

    file_put_contents($file, $content);

    echo "OK";
} else {
    echo "Неверный метод запроса";
}
?>
