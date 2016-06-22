<?php
                    
  //$host = "10.105.36.148";
  $host = "adomne.rs";
  $username = "esjb1557_asajfar";
  $password = "Martha123";
  $db = "esjb1557_tsexpo";		
  /*$password = "qBvK6720";*/

  $conn = mysqli_connect($host, $username, $password);
  if (!$conn) {
    die("Nije uspostavljena veza sa bazom: " . mysqli_error());
  }
  //echo "Veza sa serverom je uspostavljena";
  //echo "<br>";
  

  $select_db = mysqli_select_db($conn, "esjb1557_tsexpo");
  if (!select_db) {
    die("Database Selection Failed" . mysql_error());
  }
  //echo "Veza sa bazom je uspostavljena";
?>