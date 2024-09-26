<?php
require_once "connect.php";
session_start();

// Проверяем, установлен ли user_id в сессии
if (!isset($_SESSION['user_id'])) {
    $_SESSION["message"] = "Пользователь не авторизован!";
    header('Location: ../index.php');
    exit();
}

$title = isset($_POST["title"]) ? $_POST["title"] : false;
$description = isset($_POST["description"]) ? $_POST["description"] : false;
$user_id = $_SESSION['user_id'];

if ($title && $description) {
    // Используем подготовленный запрос
    $stmt = $conn->prepare("INSERT INTO tasks (`user_id`, `title`, `description`) VALUES ('$user_id', '$title', '$description')");

    if ($stmt->execute()) {
        $_SESSION["message"] = "Вы успешно добавили заметку!";
        header('Location: ../index.php');
    } else {
        $_SESSION["message"] = "Произошла ошибка, попробуйте снова!";
        header('Location: ../index.php');
    }

    $stmt->close(); // Закрываем подготовленный запрос
} else {
    $_SESSION["message"] = "Заполните все поля!";
    header('Location: ../index.php');
}

?>
