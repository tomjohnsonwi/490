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
    <title>Product Name Search Results</title>
  </head>
  <body>
    <!-- Header -->
    <h1 class="center">Hello <?php echo $_COOKIE['username']; ?></h1>
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

    <?php
      require_once('mysqli_connect.php');

      // sanitize
      $productName = $price = $category = $prod_id = "";
      $break = '<br>';

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $prod_id = test_input($_POST["prod_id"]);
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
      $query = "SELECT * FROM products WHERE id = '" . $prod_id . "'";
    
      // result
      $result = mysqli_query($dbc, $query);

      // close db
      mysqli_close($dbc);

      // form
      ?><form action="productUpdate.php">        
      <?php
      // results table
      echo "<table class='center' id='productNameTable'>";

      // Alice's Comment for Testing
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "<tr><td>Product Name</td><td><input type='text' id='productName' name='productName' value='" . $row["productname"] . "'></td></tr>";
        echo "<tr><td>Price</td><td><input type='text' id='price' name='price' value='" . $row["price"] . "'></td></tr>";
        echo "<tr><td>Quantity</td><td><input type='text' id='quantity' name='quantity' value='" . $row["quantity"] . "'></td></tr>";
        echo "<tr><td>Category</td><td><select id='category' name='category' value='" . $row["category"] . " <option value='" . $row["category"] . "'>" . $row["category"] . "</option><option value='games'>games</option><option value='consoles'>consoles</option><option value='equipment'>equipment</option></td></tr>";
        echo "<tr><td>Description</td><td><input type='text' id='description' name='description' value='" . $row["description"] . "'></td></tr>";
        echo "<input type='hidden' name='" . $row["id"] . "' />";
      }
      echo "</table> <div class='center'><input id='Submit' type='submit' method='POST'></div></form>";
    ?>
  </body>
</html>
