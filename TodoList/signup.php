<?php
require_once "header.php";
session_start();
if (isset($_SESSION["message"])) {
    $mes = $_SESSION["message"];
    echo "<script>alert('$mes')</script>";
    unset($_SESSION["message"]);
}
?>
<div class="container">
    <h2>Регистрация</h2>
</div>
<form method="post" action="database/signup-db.php">
    <div class="mb-3">
        <label for="login" class="form-label">Логин</label>
        <input type="login" class="form-control" id="login" name="login">
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="pass" name="pass">
    </div>
    <button type="submit" class="btn btn-primary"
        style="background-color: rgba(108, 99, 255, 1); border: none; color: white">Зарегистрироваться</button>
</form>
</body>

</html>