<?php 
session_start();


// funkcija za random string
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$korisnik = generateRandomString();
$lozinka = generateRandomString();


if (isset($_POST['submit']) || (isset($_SESSION['korisnik']) && isset($_SESSION['lozinka']))) {

 	require('db.php');
	$conn->query("SET NAMES 'utf8'");

 	function strip($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	 return $data;
	}

	$korisnik = $_POST['korisnik'];
	$lozinka = $_POST['lozinka'];

	$korisnik = strip($korisnik);
	$lozinka = strip($lozinka);

	$_SESSION['korisnik'] = $korisnik;
	$_SESSION['lozinka'] = $lozinka;	
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TS-EXPO Database</title>
        <link rel="stylesheet" href="baza.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" media="screen">
        <link rel="author" href="humans.txt">
        <script type="text/javascript">
		    function delete_user(uid)
		    {
		        if (confirm('Are You Sure to Delete this Record?'))
		        {
		            window.location.href = 'index.php?id=' + uid;
		        }
		    }
	    </script>
    </head>
    <body>
    	<header>
			<div id="logo"><a href="baza_all.php" id="logoall">Svi podaci</a></div>
    		<div>Baza podataka</div>
    	</header>
    	<!--
    	<div id="komande">
    		<div class="dugme">
	    		<a href="dodaj.php"><i class="fa fa-plus" aria-hidden="true"></i>
					<span id="dodatnitekst">Dodaj podatke</span>
				</a>
			</div>
    		   		
    	</div>
    	 -->
        
        
<?php 



	if ($korisnik == "expo2016" && $lozinka == "sajamnovisad")
	{
		

		echo "<div id=\"komande\">\n";
		echo "	<div class=\"dugme\" id=\"plus\">\n";
		echo "		<a href=\"dodaj.php\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i><span id=\"dodatnitekst\">Dodaj podatke</span></a>\n";
		echo "	</div>\n";
		echo "	<form class=\"pretraga1\" action=\"baza_all.php\" method=\"post\">\n";
		echo "		<input type=\"text\" name=\"pretraga\" placeholder=\"Unesi pojam za pretragu\">\n";
		echo "		<input type=\"submit\" name=\"trazi\" value=\"\">\n";
		echo "	</form>\n";
		echo "	<form class=\"export_excel\" action=\"export.php\" method=\"post\"><input type=\"submit\" class=\"export_button\" name=\"export_excel\" value=\"Export to Excel\"></form>\n";
		echo "	<form class=\"baza_app\" action=\"baza_app.php\" method=\"post\">\n";
		echo "		<input type=\"submit\" class=\"baza_app_button\" name=\"baza_app\" value=\"Baza prijavljenih\">\n";
		echo "	</form>\n";
		echo "</div>";


		$sqlselect = "SELECT * FROM tbl_users";
		$records = mysqli_query($conn, $sqlselect);
?>
		<table id="one-column-emphasis">
			<thead>
				<tr>
					<th>Edit</th>
					<th>Delete</th>
					<th>Ime</th>
					<th>Prezime</th>
					<th>Pol</th>
					<th>Kompanija</th>
					<th>Pozicija</th>
					<th>Email</th>
					<th nowrap>Web sajt</th>
					<th>Država</th>
					<th>Grad</th>
					<th>Adresa</th>
					<th>Telefon</th>
					<th>Mobilni</th>
					<th>Napomena</th>
					<th>Kategorija</th>
				</tr>
			</thead>
			<tbody>
			
			<?php
			
			while ($row=mysqli_fetch_array($records)) 
			{
				echo "<tr>";
					echo '<td><a href="edit.php?id=' . $row['id'] . '">Edit</a></td>';
					// echo '<td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
					echo "<td><a href=\"javascript: delete_user(" . $row['id'] . ")\">Delete</a></td>";
					echo "<td>".$row['firstname']."</td>";
					echo "<td>".$row['lastname']."</td>";
					echo "<td>".$row['gender']."</td>";
					echo "<td>".$row['company']."</td>";
					echo "<td>".$row['workposition']."</td>";
					echo "<td>".$row['email']."</td>";
					echo "<td>".$row['website']."</td>";
					echo "<td>".$row['country']."</td>";
					echo "<td>".$row['city']."</td>";
					echo "<td>".$row['address']."</td>";
					echo "<td>".$row['phone']."</td>";
					echo "<td>".$row['mobile']."</td>";
					echo "<td>".$row['note']."</td>";
					echo "<td>".$row['category']."</td>";
				echo "</tr>";
			}//end while
			?>
		</tbody>
		</table>
		

		

<?php
	}else
	{
		echo "<div id=\"loginform\"><div id=\"mainlogin\"><h1>ZABRANJEN PRISTUP!<p>Podaci koje ste uneli<br>ne zadovoljavaju potrebne<br>kriterijume.<br><br>Pokušajte ponovo</p></h1>";
		//$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
		$url = "baza_login.html";
  		echo "<a href='$url'><button type=\"submit\"><i class=\"fa fa-arrow-left\"></i></button></a></div></div>";

	}



}






?>
    </body>
</html>