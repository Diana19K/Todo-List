<?php 
include "connect.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Выполняем запрос на удаление
    $result = mysqli_query($conn, "DELETE FROM tasks WHERE id = $id");

    if ($result) {
        echo 'success'; // Возвращаем текстовый ответ
    } else {
        echo 'error'; // Возвращаем текст ошибки
    }
}