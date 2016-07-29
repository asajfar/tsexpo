<?php 
	session_start();

	require('db.php');
	$conn->query("SET NAMES 'utf8'");

	$user_ok = false;
	$korisnik = "";
	$lozinka = "";

	function evalUser($korisnik, $lozinka) 
	{
		if ($korisnik == "expo2016" && $lozinka == "sajamnovisad") 
		{
			return true;
		}
	}

	if (isset($_SESSION['korisnik']) && isset($_SESSION['lozinka'])) 
	{
		$korisnik = preg_replace('#[^a-z0-9]#i', '', $_SESSION['korisnik']);
		$lozinka = preg_replace('#[^a-z0-9]#i', '', $_SESSION['lozinka']);
		//verify the user
		$user_ok = evalUser($korisnik, $lozinka);
	}

if($user_ok) {
  
  $id = $_GET["id"];
  $sql = "DELETE FROM tbl_users WHERE id = $id";
  $result = mysqli_query($conn, $sql);

  if(! $retval ) {
    die('Could not delete data: ' . mysql_error());
  } else {
    echo "Deleted data successfully\n";
    header('Location: baza_all.php');
  }
}