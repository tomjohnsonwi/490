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
    <title>Product Update Page</title>
  </head>
  <body>
    <!-- Header -->
    <div class="green center"><img src="../css/logo.png" class='logo' alt="Logo"></div>
    <h1 class="center white">Hello <?php echo $_COOKIE['username']; ?></h1>
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
          <li id="Logout"
              class="col nav-item">
              <!-- Link -->
            <a class="list-anchor" href="productList.php">Search</a>
          </li>
        </ul>
      </div>
    </nav>

    <?php
      require_once('mysqli_connect.php');

      // sanitize
      $productName = $price = $category = $quantity = $description = "";
      $break = '<br>';

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = test_input($_POST["prod_id"]);
        $price = test_input($_POST["price"]);
        $category = test_input($_POST["category"]);
        $productName = test_input($_POST["productName"]);
        $quantity = test_input($_POST["quantity"]);
        $description = test_input($_POST["description"]);
      }

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      // check connection
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
      }
      
      // query
      $query = "UPDATE products SET productname='$productName', price='$price', quantity='$quantity', category='$category', description='$description' WHERE id='$id'";

      echo "<br><h1 class='center white'>Product Updated</h1><br><br>"
        . "<div class='listcenter white'><h2>" . $productName . "<br>"
        . "Price: $" . $price . "<br>"
        . "In stock: " . $quantity . "<br>"
        . "Category: " . $category . "<br>"
        . "Description: " . $description . "<h2></div>";

      // result
      $result = mysqli_query($dbc, $query);

      // close db
      mysqli_close($dbc);
    ?>
  </body>
</html>
