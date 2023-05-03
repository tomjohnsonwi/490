<?php
  if (empty($_COOKIE['username'])) {
    header("Location: login.php");
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
    <title></title>
  </head>
  <body>
    <!-- Header -->
    <div class="green center"><img src="../css/logo.png" class='logo' alt="Logo"></div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg topnav">
      <div class="container-fluid">
        <!-- List -->
        <ul class="navbar-nav center row">
          <!-- List Items -->
          <li id="Logout"
              class="col nav-item">
              <!-- Link -->
            <a class="list-anchor" href="logout.php">Logout</a>
            <a class="list-anchor" href="about.php">About</a>
            <a class="list-anchor" href="productList.php">Home</a>
            <a class="list-anchor" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>
    </nav>
    <h1 class="aboutus">ABOUT US</h1>
    <p class="aboutinfo">we are a group of game addicts who wanted to change how you can access video games online through a program of retro inspired gaming systems and accessories</p>
    
    <p class="aboutnames">Tom Johnson</p>
    <p class="aboutxt">About: This is some about info to take some space. This is some about info to take some space.</p>

    <div class="centersmiley">
    <img src="../css/smiley.jpg" alt="alternatetext" class="centersmiley" >
    </div>
    <br>

    <p class="aboutnames">Morgan Popp</p>
    <p class="aboutxt">About: This is some about info to take some space. This is some about info to take some space.</p>
    <div class="centersmiley">
    <img src="../css/smiley.jpg" alt="alternatetext" class="centersmiley" >
    </div>
    <br>

    <p class="aboutnames">Javier Flores</p>
    <p class="aboutxt">About: This is some about info to take some space. This is some about info to take some space.</p>
    <div class="centersmiley">
    <img src="../css/smiley.jpg" alt="alternatetext" class="centersmiley" >
    </div>
    <br>

    <p class="aboutnames">Alice Chandavong</p>
    <p class="aboutxt">About: This is some about info to take some space. This is some about info to take some space.</p>
    <div class="centersmiley">
    <img src="../css/smiley.jpg" alt="alternatetext" class="centersmiley" >
    </div>
    <br>

    <p class="aboutnames">Jonathan Hernandez</p>
    <p class="aboutxt">About: This is some about info to take some space. This is some about info to take some space.</p>
    <div class="centersmiley">
    <img src="../css/smiley.jpg" alt="alternatetext" class="centersmiley" >
    </div>
    <br>

    <p class="aboutnames">Adam Alkhatib</p>
    <p class="aboutxt">About: This is some about info to take some space. This is some about info to take some space.</p>
    <div class="centersmiley">
    <img src="../css/smiley.jpg" alt="alternatetext" class="centersmiley" >
    </div>
    <br>



  </body>
</html>
