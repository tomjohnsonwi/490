<?php
require_once('mysqli_connect.php');

// Get the ID of the product to delete
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Sanitize the ID value to prevent SQL injection
    $id = mysqli_real_escape_string($dbc, $id);

    // Execute the DELETE query to remove the product from the database
    $query = "DELETE FROM products WHERE id = '$id'";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        // The product was successfully deleted
        echo "Product deleted.";
    } else {
        // There was an error while deleting the product
        echo "Error deleting product.";
    }
} else {
    // No ID was provided in the URL
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($dbc);
?>
