<?php
include "header.php";
include "database/connect.php";

$search = isset($_GET["search"]) ? $_GET["search"] : "";

$filter = isset($_POST["taskFilter"]) ? $_POST["taskFilter"] : "";
$filter1 = isset($_POST["dfilter"]) ? $_POST["dfilter"] : "";

$query = "SELECT * FROM `tasks` WHERE user_id = " . $_SESSION["user_id"];

if (!empty($search)) {
    $query .= " AND (title LIKE '%$search%' or description like '%$search%')";
}
if ($filter !== "") {
    $query .= " AND is_completed = $filter";
}
if ($filter1 === '1') {
    $query .= " ORDER BY created_at DESC";
} elseif ($filter1 === "2") {
    $query .= " ORDER BY created_at ASC";
}
$sql = mysqli_query($conn, $query);

?>
<div class="forms">
<form action="" method="post">
    <select id="taskFilter" name="taskFilter" class="form-select1" onchange="this.form.submit()">
        <option value="" <?= $filter === '' ? "selected" : '' ?>>Все</option>
        <option value="1" <?= $filter === '1' ? "selected" : '' ?>>Выполненные</option>
        <option value="0" <?= $filter === '0' ? "selected" : '' ?>>Не выполненные</option>
    </select>
</form>

<form action="" method="post">
    <select id="dfilter" name="dfilter" class="form-select1" onchange="this.form.submit()">
        <option value="" <?= $filter1=== '' ? "selected" : '' ?>>Все</option>
        <option value="1" <?= $filter1 === '1' ? "selected" : '' ?>>Новые</option>
        <option value="0" <?= $filter1 === '0' ? "selected" : '' ?>>Старые</option>
    </select>
</form>
</div>
<div class="card1">
<?php if (mysqli_num_rows($sql) != 0) {  
    while ($app = mysqli_fetch_assoc($sql)) {  
        ?>  
        <div class="card w-50">  
            <div id="note">  
                <div class="card-body"> 
                    <form action="database/edit-db.php?id=<?= $app["id"] ?>" method="POST">
                        <div id="checkbox-content"> 
                            <input type="checkbox" name="checkbox[]" id="checkbox-<?= $app["id"] ?>" value="<?= $app["id"] ?>" onChange="updateStatus(this)" <?= $app["is_completed"]=='1' ? "checked": ""?>> 
                            <!-- <label for="checkbox">Заметка №<?= $app["id"] ?></label>  -->
                         <label for="checkbox">Заметка </label>  
                        </div> 
                        <label for="recipient-name" class="col-form-label">Название заметки:</label> 
                        <input type="text" required class="form-control" name="title" value="<?= $app["title"] ?>" /> 
                        <label for="recipient-name" class="col-form-label">Описание:</label> 

                        <input type="text" required class="form-control" name="description" value="<?= $app["description"] ?>" /> 
                      
                </div> 
                <div id="edit-and-delete">  
                <button type="submit"><img src="img\pen.png" alt=""></button>
                </form>
                    <a href="#" class="delete-task" data-id="<?= $app["id"] ?>"><img src="img/pngwing.png" alt=""></a>

                </div>  
            </div>  
        </div>
    <?php }
} else {
    echo '<div class="img1">';
    echo '<img src="img/Detective-check-footprint 1.png" alt="">';
    echo "<h2>Empty..</h2>";
    echo '</div>';
}
?>
</div>

<div class="op">
    <button id="open-modal"><img src="img/pngwing.com.png"></button>
    <div id="modal" class="modal">
        <div class="modal-content1">
            <span class="close">&times;</span>
            <h2>Новая заметка</h2>
            <form method="post" action="database/db.php">
                <label for="login" class="form-label">Название заметки</label>
                <input type="text" name="title">
                <label for="login" class="form-label">Описание</label>
                <input type="text" name="description">
                <button>Добавить</button>
            </form>
        </div>
    </div>
</div>
<script src="js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function updateStatus(checkbox) {
        if (checkbox.checked) {
            var confirmation = confirm("Вы уверены, что хотите пометить эту заметку как завершенную?");
            if (confirmation) {
                $.ajax({
                    url: 'database/status.php',
                    method: 'POST',
                    data: { taskId: checkbox.value },
                    success: function (response) {
                        console.log('Статус успешно обновлен');
                    },
                    error: function (xhr, status, error) {
                        console.error('Ошибка при обновлении статуса:', error);
                    }
                });
            } else {
                // Если пользователь отменил действие, оставляем галочку установленной 
                checkbox.checked = true;
            }
        } else {
            // Если чекбокс не отмечен, предупреждаем пользователя 
            alert("Вы не можете снять галочку с завершенной заметки.");
            checkbox.checked = true; // Снова устанавливаем галочку 
        }
    } 
</script>
<script> 
$(document).ready(function() { 
    $('.delete-task').on('click', function(e) { 
        e.preventDefault(); // Предотвращаем переход по ссылке 
        var taskId = $(this).data('id'); // Получаем ID задачи 
        
        $.ajax({ 
            url: 'database/delete-task.php', 
            type: 'POST', 
            data: { id: taskId }, 
            success: function(response) { //в случает успешного выполнения заппоса
                console.log(response); // Для отладки
                if (response.trim() === 'success') { //проверка ответа
                    // alert('Заметка успешно удалена'); 
                    $('a.delete-task[data-id="' + taskId + '"]').closest('.card').fadeOut(300, function() { 
                        $(this).remove(); 
                    }); 
                } else { 
                    alert('Ошибка при удалении заметки: ' + response); 
                } 
            }, 
            error: function() { 
                alert('Ошибка при выполнении запроса'); 
            } 
        }); 
    }); 
});
</script>
</body>

</html>