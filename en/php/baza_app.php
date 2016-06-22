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
?>

<?php if($user_ok) : ?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TS-EXPO Database</title>
        <link rel="stylesheet" href="baza.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" media="screen">
        <link rel="author" href="humans.txt">
    </head>
    <body>
    	<header>
			<div id="logo"><a href="baza_all.php" id="logoall">Svi podaci</a></div>
    		<div>Baza podataka<br>prijavljenih članova</div>
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

			

		echo "<div id=\"komande\">\n";
		// echo "	<div class=\"dugme\" id=\"plus\">\n";
		// echo "		<a href=\"dodaj.php\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i><span id=\"dodatnitekst\">Dodaj podatke</span></a>\n";
		// echo "	</div>\n";
		echo "	<div class=\"dugme\">\n";
		echo "		<a href=\"baza_all.php\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>\n";
		echo "			<span id=\"dodatnitekst\">Idi na početnu stranu</span>\n";
		echo "		</a>\n";
		echo "	</div>";
		echo "	<form class=\"pretraga\" action=\"baza_app.php\" method=\"post\">\n";
		echo "		<input type=\"text\" name=\"pretraga_app\" placeholder=\"Unesi pojam za pretragu\">\n";
		echo "		<input type=\"submit\" name=\"trazi_app\" value=\"&#xf002;\">\n";
		echo "	</form>\n";
		echo "	<form class=\"export_excel\" action=\"export_app.php\" method=\"post\"><input type=\"submit\" class=\"export_button\" name=\"export_excel\" value=\"Export to Excel\"></form>\n";
		// echo "	<form class=\"baza_app\" action=\"baza_app.php\" method=\"post\">\n";
		// echo "		<input type=\"submit\" class=\"baza_app_button\" name=\"baza_app\" value=\"Baza prijavljenih\">\n";
		// echo "	</form>\n";
		echo "</div>";



		if (isset($_POST['trazi_app']))
		{
			$searchValue = $_POST['pretraga_app'];
			$sqlselect = "SELECT * FROM `tbl_applicants` WHERE CONCAT (`id`, `firstname`, `lastname`, `gender`, `company`, `workposition`, `email`, `website`, `country`, `city`, `phone`, `status`, `username`, `question`) LIKE '%".$searchValue."%'";
			$records = mysqli_query($conn, $sqlselect);
		}
		else
		{
			$sqlselect = "SELECT * FROM tbl_applicants";
			$records = mysqli_query($conn, $sqlselect);
		}


		//$sqlselect = "SELECT * FROM tbl_users";
		//$records = mysqli_query($conn, $sqlselect);?>

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
					<th>Telefon</th>
					<th>Status</th>
					<th>Korisničko ime</th>
					<th>Pitanje</th>
				</tr>
			</thead>
			<tbody>
			
			<?php
			
			while ($row=mysqli_fetch_array($records)) 
			{
				echo "<tr>";
					echo '<td><a href="#">Edit</a></td>';
					echo '<td><a href="#">Delete</a></td>';
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['firstname']) . "</td>";
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['lastname']) . "</td>";
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['gender']) . "</td>";
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['company']) . "</td>";
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['workposition']) . "</td>";
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['email']) . "</td>";
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['website']) . "</td>";
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['country']) . "</td>";
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['city']) . "</td>";
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['phone']) . "</td>";
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['status']) . "</td>";
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['username']) . "</td>";
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['question']) . "</td>";
					//echo "<td>".$row['firstname']."</td>";
					//echo "<td>".$row['lastname']."</td>";
					//echo "<td>".$row['gender']."</td>";
					//echo "<td>".$row['company']."</td>";
					//echo "<td>".$row['workposition']."</td>";
					//echo "<td>".$row['email']."</td>";
					//echo "<td>".$row['website']."</td>";
					//echo "<td>".$row['country']."</td>";
					//echo "<td>".$row['city']."</td>";
					//echo "<td>".$row['address']."</td>";
					//echo "<td>".$row['phone']."</td>";
					//echo "<td>".$row['mobile']."</td>";
					//echo "<td>".$row['note']."</td>";
					//echo "<td>".$row['category']."</td>";
				echo "</tr>";
			}//end while
			?>
		</tbody>
		</table>
    </body>
</html>
<?php endif; ?>