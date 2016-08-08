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
        <script type="text/javascript">
		    function delete_user(uid,fname,lname,company,mail)
		    {
		        if (confirm('Da li ste sigurni da želite da obrišete ovog korisnika?\n\nIME: ' + fname + '\nPREZIME: ' + lname + '\nKOMPANIJA: ' + company + '\nEMAIL: ' + mail))
		        {
		            window.location.href = 'baza_all.php?id=' + uid;
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

			

		echo "<div id=\"komande\">\n";
		echo "	<div class=\"dugme\" id=\"plus\">\n";
		echo "		<a href=\"dodaj.php\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i><span id=\"dodatnitekst\">Dodaj podatke</span></a>\n";
		echo "	</div>\n";
		echo "	<form class=\"pretraga\" action=\"baza_all.php\" method=\"post\">\n";
		echo "		<input type=\"text\" name=\"pretraga\" placeholder=\"Unesi pojam za pretragu\">\n";
		echo "		<input type=\"submit\" name=\"trazi\" value=\"&#xf002;\">\n";
		echo "	</form>\n";
		echo "	<form class=\"export_excel\" action=\"export.php\" method=\"post\"><input type=\"submit\" class=\"export_button\" name=\"export_excel\" value=\"Export to Excel\"></form>\n";
		echo "	<form class=\"duplikat\" action=\"duplikat.php\" method=\"post\"><input type=\"submit\" class=\"duplikat_button\" name=\"duplikat\" value=\"Pronađi duplikate (email)\"></form>\n";
		echo "	<form class=\"baza_app\" action=\"baza_app.php\" method=\"post\">\n";
		echo "		<input type=\"submit\" class=\"baza_app_button\" name=\"baza_app\" value=\"Baza prijavljenih\">\n";
		echo "	</form>\n";
		echo "</div>";


		// Ako je pritisnito duplikat
		if (isset($_POST['duplikat']))
		{
			
			$sqlselect = "SELECT DISTINCT id, firstname, lastname, company, email, city, address, phone, mobile, note, category, count(*) FROM tbl_users GROUP BY email HAVING count(id) > 1";
			$records = mysqli_query($conn, $sqlselect);

		}?>
		
		<div class="uputstvo">Klikni na broj da vidiš duplikate!</div>
		<table id="one-column-emphasis">
			<thead>
				<tr>
					<th>Email</th>
					<th>Broj duplikata</th>
				</tr>
			</thead>
			<tbody>

			<?php

			while ($row=mysqli_fetch_array($records)) 
			{
				echo "<tr>";
					echo "<td>" . str_replace($searchValue, "<span class=\"highlight\">$searchValue</span>", $row['email']) . "</td>";
					echo '<td class="tdcenter"><a class="duplo" href="baza_all.php?email=' . $row['email'] . '">' . $row['count(*)'] . '</a></td>';
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
