<?php
  DEFINE ('DB_HOST', 'localhost');
  DEFINE ('DB_USERNAME', 'john4887_john4887');
  DEFINE ('DB_PASSWORD', 'password2022');
  DEFINE ('DB_NAME', 'john4887_finalproject');

  $dbc = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME) OR 
  die ('Could not connect to MySQL: '. mysqli_connect_error());
  
?>