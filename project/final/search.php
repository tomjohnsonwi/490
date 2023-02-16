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
    <title>Search Page</title>
  </head>
  <body>
    <!-- Header -->
    <h1 class="center">Hello <?php echo $_COOKIE['username']; ?>, Search Our Store!</h1>
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
          </li>
        </ul>
      </div>
    </nav>

    <div class="form-div">
      <!-- Product Name -->
      <form id='productNameForm' action="productList.php" method="POST">
        <label for="productName">Search by name:</label>
        <input type="text" id="productName" name="productName">
        <input id="SubmitName" type="submit">
      </form>

      <!-- Price -->
      <form id='priceForm' action="price.php" method="POST">
        <label for="price">Search by price, between:</label>
        <span>$ </span><input class="inputselect" type="number" id="minPrice" name="minPrice" min="0" max="500" step="50" onkeydown="return false">
        and $
        <input type="number" class="inputselect" id="maxPrice" name="maxPrice" min="0" max="500" step="50" onkeydown="return false">
        <br><br>
        <input id="SubmitPrice" type="submit">
      </form>

      <!-- Category -->
      <form id='categoryForm' action="category.php" method="POST">
        <label for="category">Search by category:</label>
        <select name="category" id="category">
          <?php
            // category array
            $category = array('games', 'consoles', 'equipment');
            // populate $category options
            foreach($category as $item) {
              echo "<option value='$item'>$item</option>";
            }
          ?>
        </select>
        <input id="SubmitCategory" type="submit">
      </form>
    </div>

    <script type="text/javascript">
      
    </script>
  </body>
</html>