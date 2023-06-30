<?php     
  // Establish a database connection
  $hostname = 'localhost';
  $database = 'newoops';
  $username = 'root';
  $password = '';
  
  try{
    $db = mysqli_connect($hostname, $username, $password, $database);
  }catch(mysqli_sql_exception) {
    die("Connection failed: " . mysqli_connect_error());
  }