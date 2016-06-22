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

	<?php  
		$sqlselect = "SELECT * FROM tbl_applicants";
		$records = mysqli_query($conn, $sqlselect);
	?>

<html>
    <head>
        <meta charset="utf-8">
    </head>

		<table id="one-column-emphasis" border="1">
			<thead>
				<tr>
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
					echo "<td>".$row['firstname']."</td>";
					echo "<td>".$row['lastname']."</td>";
					echo "<td>".$row['gender']."</td>";
					echo "<td>".$row['company']."</td>";
					echo "<td>".$row['workposition']."</td>";
					echo "<td>".$row['email']."</td>";
					echo "<td>".$row['website']."</td>";
					echo "<td>".$row['country']."</td>";
					echo "<td>".$row['city']."</td>";
					echo "<td>".$row['phone']."</td>";
					echo "<td>".$row['status']."</td>";
					echo "<td>".$row['username']."</td>";
					echo "<td>".$row['question']."</td>";
				echo "</tr>";
			}//end while
			?>
		</tbody>
		</table>
	</html>	
<?php endif; ?>