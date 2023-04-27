<?php
  if (!empty($_COOKIE['username'])) {
    header("Location: productList.php");
    exit();
  }
?>

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
    <title>Login</title>
  </head>
  <body>
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

    <!-- form -->
    <form action="handle_login.php" class='center form' name="myForm" method="POST">
      <!-- text box -->
      <div class="row">
        <div class="col">
          <label for="username">Username</label><br>
          <input id="username" name="username" type="text">
        </div>
        <div class="col">
          <label for="password">Password</label><br>
          <input id="password" name="password" type="password">
        </div>
      </div>
      <br>

      <!-- submit -->
      <input id="Submit" type="submit">
      <label></label>
      <br><br>
    </form>

    <form action="handle_login.php" method="POST">
      <div class="center">
        <input id="username" name="username" type="hidden" value="guest">
        <input id="password" name="password" type="hidden" value="guest">
        <button class="shopasguest" type="submit" name='guest'><h1>Shop as guest</h1></button>
      </div>
    </form>
  </body>
</html>