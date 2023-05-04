<?php 
// db connection
require_once('mysqli_connect.php');

// sanitize
$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
$passtwo = mysqli_real_escape_string($dbc, trim($_POST['passtwo']));

// query
$users = "INSERT INTO `users`(`username`, `pw`) VALUES ('$username', sha2('$passtwo', 224))";
$result = mysqli_query($dbc, $users);
$query = "SELECT * from users WHERE username = '$username' AND pw = SHA2('$passtwo', 224)";

// run query
$result2 = mysqli_query($dbc, $query);

// close db
mysqli_close($dbc);

// user matches db row
if (mysqli_num_rows($result2) >= 1) {
  // set cookie
  setcookie('username', $username);
  header("Location: productList.php");
  exit();
}
else {
  // redirect to login page
  header("Location: signup.php");

  // terminate current script
  exit();
}

?>