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
      <form action="productList.php" method="POST">
        <!-- Product Name -->
        <label for="productName">Search by name:</label>
        <input type="text" id="productName" name="productName">
        <input id="SubmitName" type="submit">
        <br><br>

        <!-- Price -->
        <label for="price">Search by price, between:</label>
        <span>$ </span><input class="inputselect" type="number" id="minPrice" name="minPrice" min="0" max="500" step="50" onkeydown="return false">
        and $
        <input type="number" class="inputselect" id="maxPrice" name="maxPrice" min="0" max="500" step="50" onkeydown="return false">
        <br><br>
        <input id="SubmitPrice" type="submit">
        <br><br>
        <!-- Category -->
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

    <?php
      require_once('mysqli_connect.php');

      // sanitize
      $productName = $price = $category = $id = "";
      $break = '<br>';

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productName = test_input($_POST["productName"]);
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
      $query = "SELECT * FROM products";

    
      // result
      $result = mysqli_query($dbc, $query);

      // close db
      mysqli_close($dbc);

      // add new record if admin == 1
      if ("admin" == 1) {
        echo "<form><table class='center' id='productNameTable'>";
        echo "<th>Product Name</th><th>Price</th><th>Quantity</th><th>Category</th><th>Description</th><th>Edit</th>";
        echo "<tr><td>" 
          . "<input type='text' id='productName' name='productName' value='" . $_GET['productName'] . "'></td>"
          . "<td><input type='text' id='price' name='price' value='" . $_GET['price'] . "'></td>"
          . "<td><input type='text' id='quantity' name='quantity' value='" . $_GET['quantity'] . "'></td>"
          . "<td><input type='text' id='description' name='description' value='" . $_GET['description'] . "'></td>"
          . "<td><select id='category' name='category' value='" . $_GET['category'] . "'></option><option value='games'>games</option><option value='consoles'>consoles</option><option value='equipment'>equipment</option></td>"
          . "<td><form id='resultsForm' method='post' action='productEdit.php'>"
          . "<input name='prod_id' type='hidden' value='" 
          . $row["id"] . "' /><button type='submit' class='addToCart'>Edit</button></form>"
          . "<form id='resultsForm' method='post' action='productEdit.php'>"
          . "<input name='prod_id' type='hidden' value='" . $row["id"] . "' />"
          . "<button type='submit' class='productDelete'>Delete</button></form> </td></tr>"
          . "</table><button type='submit' class='addToCart'>Add</button></form>";
          // if (!isempty($_GET['productName']) && !isempty($_GET['price']) && !isempty($_GET['quantity']) && !isempty($_GET['description']) && !isempty($_GET['category'])) {
          //   $sql = "INSERT INTO products ($_GET['productName'], $_GET['price'], $_GET['quantity'], $_GET['description'], $_GET['category'])
          //   VALUES ($_GET['productName'], $_GET['price'], $_GET['quantity'], $_GET['description'], $_GET['category'])";
    
          //   if ($conn->query($sql) === TRUE) {
          //     echo "New record created successfully";
          //   } else {
          //     echo "Error: " . $sql . "<br>" . $conn->error;
          //   }
          // }
      }

      // search price results
      // Need to test this with TOM
      require_once('mysqli_connect.php');
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $minPrice = test_input($_POST["minPrice"]);
        $maxPrice = test_input($_POST["maxPrice"]);
      
      
      // query
      $query = "SELECT * FROM products WHERE price >= $minPrice AND price <= $maxPrice";
      
        // result
        $result = mysqli_query($dbc, $query);

        // close db
        // mysqli_close($dbc);

        // results table
        echo "<table class='center' id='productNameTable'>";
        echo "<th>Price</th><th>Product Name</th><th>Quantity</th><th>Category</th><th>Description</th><th>Add to Cart</th>";
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          echo "<tr><td>" . $row["price"] . "</td><td>" . $row["productname"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["category"] . "</td><td>" . $row["description"]  . "<td><form id='resultsForm' method='post' action='cart.php'><button type='submit' class='addToCart'>Purchase</button></form></td></tr>";
        }
        echo "</table>";
      }
      else {
        echo "<h1 class='center'>You did not enter a valid price query</h1>";
      }

      // search name results
      require_once('mysqli_connect.php');
      if (!empty($productName)) {
        // query
        $query = "SELECT * FROM products WHERE productname LIKE '%$productName%'";
      
        // result
        // $result = mysqli_query($dbc, $query);

        // close db
        // mysqli_close($dbc);

        // results table
        echo "<table class='center' id='productNameTable'>";
        echo "<th>Product Name</th><th>Price</th><th>Quantity</th><th>Category</th><th>Description</th><th>Add to Cart</th>";
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          echo "<tr><td>" . $row["productname"] . "</td><td>" . $row["price"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["category"] . "</td><td>" . $row["description"]  . "<td><form id='resultsForm' method='post' action='cart.php'><button type='submit' class='addToCart'>Purchase</button></form></td></tr>";
        }
        echo "</table>";
      }
      else {
        echo "<h1 class='center'>You did not enter a name</h1>";
      }

      // search category
      require_once('mysqli_connect.php');
      if (!empty($category)) {
        // query
        $query = "SELECT * FROM products WHERE category LIKE '%$category%'";
      
        // result
        // $result = mysqli_query($dbc, $query);

        // close db
        // mysqli_close($dbc);

        // results table
        echo "<table class='center' id='productNameTable'>";
        echo "<th>Category</th><th>Product Name</th><th>Price</th><th>Quantity</th><th>Description</th><th>Add to Cart</th>";
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          echo "<tr><td>" . $row["category"] . "</td><td>" . $row["productname"] . "</td><td>" . $row["price"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["description"] . "</td><td><form id='resultsForm' method='post' action='cart.php'><button type='submit' class='addToCart'>Purchase</button></form></td></tr>";
        }
        echo "</table>";
      }
      // else {
      //   echo "<h1 class='center'>You did not enter a category</h1>";
      // }

      // results table
      echo "<table class='center' id='productNameTable'>";
      echo "<th>Product Name</th><th>Price</th><th>Quantity</th><th>Category</th><th>Description</th><th>Edit</th>";
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "<tr><td>" 
        . $row["productname"] 
        . "</td><td>" . $row["price"] 
        . "</td><td>" . $row["quantity"] 
        . "</td><td>" . $row["category"] 
        . "</td><td>" . $row["description"]  
        . "<td><form id='resultsForm' method='post' 
        action='productEdit.php'><input name='prod_id' type='hidden' value='" . $row["id"] . "' />
        <button type='submit' class='addToCart'>Edit</button></form> 
        <form id='resultsForm' method='post' action='productDelete.php'><input name='prod_id' type='hidden' value='" . $row["id"] . "' /><button type='submit' class='addToCart'>Delete</button></form> 
        </td></tr>";
      }
      echo "</table>";
    ?>
  </body>
</html>
