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
  <h1 class="aboutus">CONTACT US</h1>
  <p class="aboutnames">Location:</p>
 
  
  <div class="centerlocation">
  <img src="../css/location.jpg" alt="alternatetext" class="centerlocation" >
  </div>
  <br>
 
  <p class="aboutus">ADDRESS</p>
  <p class="aboutxt">1234 Innovation Way, Milwaukee WI, 53233</p>
  <br>
  
  <p class="aboutnames">Customer Support</p>
  
  <p class="aboutus">SUPPORT</p>
  <p class="aboutxt">support@gamethief.com</p>
  <p class="aboutxt">414.242.6171</p>
  
  <p class="aboutus">SALES</p>
  <p class="aboutxt">sales@gamethief.com</p>
  <p class="aboutxt">414.242.6177</p>
  <br>

  <p class="aboutnames">Returns</p>
  <p class="aboutus">POLICY</p>
  <p class="aboutxt">This is our return policy. This is our return policy. This is our return policy.</p>
  <br>
  








  </body>
</html>
