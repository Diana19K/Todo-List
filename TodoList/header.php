<?php
session_start();
if (isset($_SESSION["message"])) {
  $mes = $_SESSION["message"];
  echo "<script>alert('$mes')</script>";
  unset($_SESSION["message"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarNav">
        <!-- <div class="search-bar">
          <div class="search-icon">
            <img src="img/Vector.png" alt="Search Icon">
          </div>
          <input type="text" placeholder="Search note...">
        </div> -->
        <form action="" method="get">
          <div class="p">
            <div class="search-bar">
              <input type="text" name="search" placeholder="Search note...">
              <div class="search-icon">
                <!-- <button><img src="img/Vector.png" alt="Search Icon"></button> -->
              </div>
            </div>
        </form>
      </div>
      <ul class="navbar-nav">
        <?php if (isset($_SESSION["user_id"])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" style="color: white">Выйти</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="signin.php" style="color: white">Вход</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signup.php" style="color: white">Регистрация</a>
          </li>
        <?php } ?>
      </ul>

    </div>
    </div>


  </nav>
  <div class="container">
    <h1>TODO LIST</h1>
  </div>
</body>

</html>