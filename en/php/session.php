<?php
   require('db.php');
   $conn->query("SET NAMES 'utf8'");
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($conn,"SELECT firstname, lastname, username from tbl_applicants where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $login_firstname = $row['firstname'];
   $login_lastname = $row['lastname'];

   
   if(!isset($_SESSION['login_user'])){
      header("location:../login.php");
   }
?>