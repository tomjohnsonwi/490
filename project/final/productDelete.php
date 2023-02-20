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
    <title>Deletion Page</title>
  </head>
  <body>
    <!-- Header -->
    <h1 class="center">Hello <?php echo $_COOKIE['username']; ?>, welcome to the Delete Product Page</h1>
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

  // Get the ID of the product to delete
  if (isset($_POST['prod_id'])) {
    $id = $_POST['prod_id'];

    // Sanitize the ID value to prevent SQL injection
    $id = mysqli_real_escape_string($dbc, $id);

    // Execute the DELETE query to remove the product from the database
    $query = "DELETE FROM products WHERE id = '$id'";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        // The product was successfully deleted
        echo "<div class='center'><h1>Product " . $id . " deleted.</h1></div>";
        // echo $_POST['productName'] . "<br>" . $_POST['category'] . "<br>" . $_POST['quantity'] . "<br>" . $_POST['description'];
    } else {
        // There was an error while deleting the product
        echo "<div class='center'><h1>Error deleting product.</h1></div>";
    }
  } else {
    // No ID was provided in the URL
    echo "<div class='center'>Invalid request.</h1></div>";
  }

  // Close the database connection
  mysqli_close($dbc);
?>
