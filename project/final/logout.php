<?php
  setcookie('username', '');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dongle&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Logged out</title>
    <!--    TDJ-06-27-2022     -->
  </head>
  <body>
    <!-- Header -->
    <div class="green center"><img src="../css/logo.png" class='logo' alt="Logo"></div>
    <h1 class="center white">Logged out</h1>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg topnav">
      <div class="container-fluid">
        <!-- List -->
        <ul class="navbar-nav center row">
          <!-- List Items -->
          <li id="Login"
              class="col nav-item">
              <!-- Link -->
            <a class="list-anchor" href="login.php">Login</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="center">
      <h1 class="white">You have successfully logged out, sorry to see you go</h1>
      <br><br>
      <button class="login" type="button" onclick="location.href='login.php';">Login</button>
    </div>
  </body>
</html>