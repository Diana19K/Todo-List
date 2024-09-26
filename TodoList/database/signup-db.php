<?php
require_once "connect.php";
session_start();

$login = isset($_POST["login"]) ? $_POST["login"] : false;
$pass = isset($_POST["pass"]) ? $_POST["pass"] : false;

if ($login and $pass) {
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password_hash) VALUES ('$login', '$hashed_password')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION["message"] = "Регистрация прошла успешно!";
        header('Location: ../index.php'); 
    } else {
        $_SESSION["message"] = "Ошибка регистрации!";
        header('Location: ../signup.php');
    }
} else {
    $_SESSION["message"] = "Заполните все поля!";
    header('Location: /');
}
?>