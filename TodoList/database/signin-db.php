<?php
require_once "connect.php";
session_start();

$login = isset($_POST["login"]) ? $_POST["login"] : false;
$pass = isset($_POST["pass"]) ? $_POST["pass"] : false;

if ($login and $pass) {
    $sql = "SELECT * FROM users WHERE username= '$login'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) != 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($pass, $user["password_hash"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["message"] = "Добро пожаловать!";
            header('Location: ../index.php');
        } else {
            $_SESSION["message"] = "Неверный пароль!";
            header('Location: ../signin.php');
        }
    } else {
        $_SESSION["message"] = "Неверный логин!";
        header('Location: ../signin.php');
    }
} else {
    $_SESSION["message"] = "Заполните все поля!";
    header('Location: ../signin.php');
}
?>