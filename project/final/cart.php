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
        </ul>
      </div>
    </nav>

    <?php
      require_once('mysqli_connect.php');

      // sanitize
      $productName = $price = $category = $id = "";
      $break = '<br>';

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productName = test_input($_POST["productName"]);
        $price = test_input($_POST["price"]);
        $category = test_input($_POST["category"]);
        $id = test_input($_POST["id"]);
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
      
      // product added to cart from productList.php
      // $query = "SELECT * FROM products WHERE ";
    
      // result
      $result = mysqli_query($dbc, $query);
      $row = mysqli_fetch_assoc($adminresult);

      // results table
      echo "<table class='center' id='productNameTable'>";
      echo "<th>Product Name</th><th>Price</th><th>Quantity</th><th>Category</th><th>Description</th>";
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "<tr><td>" 
        . $row["productname"] 
        . "</td><td>" . $row["price"] 
        . "</td><td>" . $row["quantity"] 
        . "</td><td>" . $row["category"] 
        . "</td><td>" . $row["description"]  
        . "</tr>";
      }
      echo "</table>";

      // close db
      mysqli_close($dbc);
    ?>
  </body>
</html>
