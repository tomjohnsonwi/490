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
    <title>Add Product Page</title>
  </head>
  <body>
    <!-- Header -->
    <h1 class="center">Hello <?php echo $_COOKIE['username']; ?>, welcome to the Add Product Page</h1>
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

  $productName = $_POST['productName'];
  $category = $_POST['category'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $description = $_POST['description'];

  // Execute the insert query to add entry to the database
  $query = "INSERT INTO `products`(`productname`, `category`, `price`, `quantity`, `description`) VALUES ('" . $productName . "', '" . $category . "', '" . $price . "', '" . $quantity . "', '" . $description . "')";
  $result = mysqli_query($dbc, $query);

  echo $result;
  
  if ($result) {
      // The product was successfully updated
      echo "<div class='center'><h1>Product: " . $productName . "<br>Category: " . $category . "<br>Price: $" . $price . "<br>Quantity: " . $quantity . "<br>Description: " . $description . "<br><br>" . " Added Successfully.</h1></div>";
  } else {
      // There was an error while updating the product
      echo "Error adding product.";
  }

  // Close the database connection
  mysqli_close($dbc);
?>
