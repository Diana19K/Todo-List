<?php
require_once "connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $taskId = $_POST['taskId']; 
    $taskId = intval($taskId); // Приведение к целому числу
    $sql = "UPDATE tasks SET is_completed = 1 WHERE id = $taskId"; 

    if ($conn->query($sql) === TRUE) { 
        header("Location: /user.php"); 
        exit(); 
    } else { 
        echo "Ошибка при обновлении статуса: " . $conn->error; 
    } 
} 