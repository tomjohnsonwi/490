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
    <title>Your cart</title>
  </head>
  <body>
    <!-- Header -->
    <h1 class="center">Hello <?php echo $_COOKIE['username']; ?>, Ready to Check Out?</h1>
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
          <li id="Back"
              class="col nav-item">
              <!-- Link -->
            <a class="list-anchor" href="productList.php">Back to Product List</a>
          </li>
        </ul>
      </div>
    </nav>

    <?php
      require_once('mysqli_connect.php');

      // check connection
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
      }

      // sanitize
      $productName = $price = $category = $id = $description = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productName = test_input($_POST["productname"]);
        $price = test_input($_POST["price"]);
        $category = test_input($_POST["category"]);
        $id = test_input($_POST["prod_id"]);
        $description = test_input($_POST["description"]);
      }

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      // Get the ID of the product to add to cart
      if (isset($_POST['prod_id'])) {
        $id = $_POST['prod_id'];

        // Sanitize the ID value to prevent SQL injection
        $id = mysqli_real_escape_string($dbc, $id);

        $query = "INSERT INTO `cart`(
          `username`, 
          `productname`, 
          `category`, 
          `description`, 
          `price`
          ) VALUES (
            '" . $_COOKIE['username'] . 
            "', '" . $productName . 
            "', '" . $category . 
            "', '" . $description . 
            "', '" . $price . 
          "')";
        $result = mysqli_query($dbc, $query);

        // add to cart from productList.php
        // $query = "insert into cart
        //         (
        //           username,
        //           productname,
        //           category, 
        //           description, 
        //           price
        //         )
        //         values (
        //           ".$_COOKIE['username'].",
        //           $productName,
        //           $category,
        //           $description,
        //           $price
        //         )
        //         from users, product where id = $id";

        // $result = mysqli_query($dbc, $query);

        if ($result) {
            // The product was successfully added to cart
            echo "<div class='center'><h1>Product " . $id . " added.</h1></div>";
        } else {
            // There was an error while adding the product
            echo "<div class='center'><h1>Error adding product.<br><br>Result: $result<br><br>$query</h1></div>";
        }
      } else {
        // No ID was provided in the URL
        echo "<div class='center'>Invalid request.</h1></div>";
      }

      // cart table
      echo "<table class='center' id='productNameTable'>";
      echo "<th>Product Name</th><th>Price</th><th>Category</th><th>Description</th>";
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "<tr><td>" 
        . $row["productname"] 
        . "</td><td>" . $row["price"]
        . "</td><td>" . $row["category"] 
        . "</td><td>" . $row["description"]  
        . "</td></tr>";
      }
      echo "</table>";

      // Close the database connection
      mysqli_close($dbc);
    ?>
  </body>
</html>
