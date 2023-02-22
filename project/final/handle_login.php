<?php 
// db connection
require_once('mysqli_connect.php');

// sanitize
$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
$password = mysqli_real_escape_string($dbc, trim($_POST['password']));

// query
$query = "SELECT * from users WHERE username = '$username' AND pw = SHA2('$password', 224)";
$guestquery = "SELECT * from users WHERE username = 'guest' AND pw = 'guest'";
  
// run query
$result = mysqli_query($dbc, $query);
$guestresult = mysqli_query($dbc, $guestquery);

// get admin boolean

// user matches db row
if (mysqli_num_rows($result) == 1) {
  // set cookie before echo
  
  // TODO redirect to search page if not admin
  if ($username == 'mu' && $password == 'pw') {
    setcookie('username', $username);
    header("Location: productList.php");
    exit();
  }
  setcookie('username', $username);
  header("Location: productList.php");
  exit();
}
else if (mysqli_num_rows($guestresult) == 1) {
  // set cookie before echo
  setcookie('username', 'guest');
  header("Location: productList.php");
  exit();
}
else {
  // redirect to login page
  header("Location: login.php");

  // terminate current script
  exit();
}

?>
