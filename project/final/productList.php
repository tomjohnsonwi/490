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
    <title>Product Search</title>
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
      <form action="nameSearch.php" method="POST">
        <label for="productName">Search by name:</label>
        <input type="text" id="productName" name="productName">
        <input id="SubmitName" type="submit">
      </form>

      <!-- Price -->
      <form action="priceSearch.php" method="POST">
        <label for="price">Search by price, between:</label>
        <span>$ </span><input class="inputselect" type="number" id="minPrice" name="minPrice" min="0" max="500" step="50" onkeydown="return false">
        and $
        <input type="number" class="inputselect" id="maxPrice" name="maxPrice" min="0" max="500" step="50" onkeydown="return false">
        <br><br>
        <input id="SubmitPrice" type="submit">
      </form>

      <!-- Category -->
      <form action="categorySearch.php" method="POST">
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
      
      // query
      $query = "SELECT * FROM products";
    
      // result
      $result = mysqli_query($dbc, $query);

      // add new record if admin == mu
      if ($_COOKIE['username'] == 'mu') {
        echo "<form method='post' action='productAdd.php'><table class='center' id='productNameTable'>";
        echo "<th>Product Name</th><th>Price</th><th>Quantity</th><th>Description</th><th>Category</th><th>Add</th>";
        echo "<tr><td>" 
          . "<input type='text' id='productName' name='productName'></td>"
          . "<td>$<input type='text' id='price' name='price'></td>"
          . "<td><input type='text' id='quantity' name='quantity'></td>"
          . "<td><input type='text' id='description' name='description'></td>"
          . "<td><select id='category' name='category'></option>
              <option value='games'>games</option>
              <option value='consoles'>consoles</option>
              <option value='equipment'>equipment</option>
            </td>"
          . "<td><button type='submit' class='addToCart'>Add</button></form></td></tr>"
          . "</table>";
      }

      // admin view
      if ($_COOKIE['username'] == 'mu') {
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
          . "<td><form id='resultsForm' method='post' action='productEdit.php'>
          <input name='prod_id' type='hidden' value='" . $row["id"] . "' />
          <button type='submit' class='addToCart'>Edit</button></form> 
          <form id='resultsForm' method='post' action='productDelete.php'>
          <input name='prod_id' type='hidden' value='" . $row["id"] . "' />
          <button type='submit' class='addToCart'>Delete</button></form> 
          </td></tr>";
        }
        echo "</table>";
      }
      // guest view
      else {
        // results table
        echo "<table class='center' id='productNameTable'>";
        echo "<th>Product Name</th><th>Price</th><th>Quantity</th><th>Category</th><th>Description</th><th>Add</th>";
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          echo "<tr><td>" 
          . $row["productname"] 
          . "</td><td>" . $row["price"] 
          . "</td><td>" . $row["quantity"] 
          . "</td><td>" . $row["category"] 
          . "</td><td>" . $row["description"]  
          . "<td> 
          <form id='resultsForm' method='post' action='cart.php'>
          <input name='prod_id' type='hidden' value='" . $row["id"] . "' />
          <button type='submit' class='addToCart'>Add</button></form> 
          </td></tr>";
        }
        echo "</table>";
      }

      // close db
      mysqli_close($dbc);
    ?>
  </body>
</html>
