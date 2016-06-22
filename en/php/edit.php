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

/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable

function renderForm($id, $firstname, $lastname, $gender, $company, $workposition, $email, $website, $country, $city, $address, $phone, $mobile, $note, $category, $poruka)
 {
 	?>
	 <!doctype html>
	 <html>
		<head>
		<meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NS-EXPO Database - Izmena podataka</title>
        <link rel="stylesheet" href="baza.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" media="screen">
        <link rel="author" href="humans.txt">	
		</head>
			 <body>
				 <header>
					<div id="logo"><a href="baza_all.php" id="logoall">Svi podaci</a></div>
		    		<div>Baza podataka</div>
		    	</header>
		    	<div id="komande">
		    		<div class="dugme">
			    		<a href="baza_all.php"><i class="fa fa-home" aria-hidden="true"></i>
							<span id="dodatnitekst">Idi na početnu stranu</span>
						</a>
					</div>
    		   		
    			</div>	
			 <?php 
				 // if there are any errors, display them
				 if ($poruka != '')
				 {
				 echo $poruka;
				 }
			 ?> 
			 
			 <form class="form-horizontal" role="form" action="" method="POST">
				 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
				 <div class="form-group">
          			<label  class="control-label" for="firstname">First name</label>
          			<div class="polje">
              			<input type="text" name="firstname" class="form-control" id="firstname" value="<?php echo $firstname; ?>"/>
          			</div>
        		</div>
		        <div class="form-group">
		          <label  class="control-label" for="lastname">Last name</label>
		          <div class="polje">
		              <input type="text" name="lastname" class="form-control" id="lastname" value="<?php echo $lastname; ?>"/>
		          </div>
		        </div>
		        <div class="form-group">
		          <label  class="control-label" for="gender">Gender</label>
		          <div class="polje">
		            <label class="radio-inline"><input class="radioinput1" type="radio" name="gender" value="Male" <?php echo ($gender=='Male')?'checked':'' ?> >Male</label>
		            <label class="radio-inline"><input class="radioinput2" type="radio" name="gender" value="Female" <?php echo ($gender=='Female')?'checked':'' ?> >Female</label>
		          </div>
		        </div>
		        <div class="form-group">
		          <label  class="control-label" for="company">Company</label>
		          <div class="polje">
		              <input type="text" name="company" class="form-control" id="company" value="<?php echo $company; ?>"/>
		          </div>
		        </div>
		        <div class="form-group">
		          <label  class="control-label" for="workposition">Work Position</label>
		          <div class="polje">
		              <input type="text" name="workposition" class="form-control" id="workposition" value="<?php echo $workposition; ?>"/>
		          </div>
		        </div>
		        <div class="form-group">
		          <label  class="control-label" for="email">Email</label>
		          <div class="polje">
		              <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>"/>
		          </div>
		        </div>
		        <div class="form-group">
		          <label  class="control-label" for="website">Website</label>
		          <div class="polje">
		              <input type="text" name="website" class="form-control" id="website" value="<?php echo $website; ?>"/>
		          </div>
		        </div>
		        <div class="form-group">
		          <label  class="control-label" for="country">Country</label>
		          <div class="polje">
		              <input type="text" name="country" class="form-control" id="country" value="<?php echo $country; ?>"/>
		          </div>
		        </div>
		        <div class="form-group">
		          <label  class="control-label" for="city">City</label>
		          <div class="polje">
		              <input type="text" name="city" class="form-control" id="city" value="<?php echo $city; ?>"/>
		          </div>
		        </div>
		        <div class="form-group">
		          <label  class="control-label" for="address">Address</label>
		          <div class="polje">
		              <input type="text" name="address" class="form-control" id="address" value="<?php echo $address; ?>"/>
		          </div>
		        </div>
		        <div class="form-group">
		          <label  class="control-label" for="phone">Phone</label>
		          <div class="polje">
		              <input type="text" name="phone" class="form-control" id="phone" value="<?php echo $phone; ?>"/>
		          </div>
		        </div>
		        <div class="form-group">
		          <label  class="control-label" for="mobile">Mobile</label>
		          <div class="polje">
		              <input type="text" name="mobile" class="form-control" id="mobile" value="<?php echo $mobile; ?>"/>
		          </div>
		        </div>
		        <div class="form-group">
		          <label  class="control-label" for="note">Note</label>
		          <div class="polje">
		              <textarea rows="5" name="note" class="form-control" id="note"><?php echo $note; ?></textarea>
		          </div>
		        </div>
		        <div class="form-group">
		          <label  class="control-label" for="category">Category</label>
		          <div class="polje">
		              <input type="text" name="category" class="form-control" id="category" value="<?php echo $category; ?>"/>
		          </div>
		        </div>
		        <div class="form-group">
		          <div class="dugmeform">
		            <input type="submit" name="izmeni" class="btn btn-default" value="Zapamti podatke"/>
		          </div>
		        </div>
			 </form> 
			 </body>
	 </html> 
<?php
 }
 

 $trn_date = date("Y-m-d H:i:s");


 if ($user_ok) 
 {
 	 // check if the form has been submitted. If it has, process the form and save it to the database
	 if (isset($_POST['izmeni']))
	 { 
		 // confirm that the 'id' value is a valid integer before getting the form data
		 if (is_numeric($_GET['id']))
		 {
			 // get form data, making sure it is valid
			 $id = $_GET['id'];
			 $firstname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['firstname']));
			 $lastname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['lastname']));
			 $gender = mysqli_real_escape_string($conn, htmlspecialchars($_POST['gender']));
			 $company = mysqli_real_escape_string($conn, htmlspecialchars($_POST['company']));
			 $workposition = mysqli_real_escape_string($conn, htmlspecialchars($_POST['workposition']));
			 $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
			 $website = mysqli_real_escape_string($conn, htmlspecialchars($_POST['website']));
			 $country = mysqli_real_escape_string($conn, htmlspecialchars($_POST['country']));
			 $city = mysqli_real_escape_string($conn, htmlspecialchars($_POST['city']));
			 $address = mysqli_real_escape_string($conn, htmlspecialchars($_POST['address']));
			 $phone = mysqli_real_escape_string($conn, htmlspecialchars($_POST['phone']));
			 $mobile = mysqli_real_escape_string($conn, htmlspecialchars($_POST['mobile']));
			 $note = mysqli_real_escape_string($conn, htmlspecialchars($_POST['note']));
			 $category = mysqli_real_escape_string($conn, htmlspecialchars($_POST['category']));

			 
				 // check that firstname/lastname fields are both filled in
				 if ($firstname == '' && $lastname == '' && $gender == '' && $company == '' && $workposition == '' && $email == '' && $website == '' && $country == '' && $city == '' && $address == '' && $phone == '' && $mobile == '' && $note == '' && $category == '')
				 {

				 // generate error message
				 $poruka = "<div class=\"uslov\">Da bi izmenili podatke potrebno je da bar jedno polje ima neku vrednost!</div>";
				 
				 //error, display form
				 renderForm($id, $firstname, $lastname, $gender, $company, $workposition, $email, $website, $country, $city, $address, $phone, $mobile, $note, $category, $poruka);
				 }
				 else
				 {

				 // save the data to the database

				 $query = "UPDATE tbl_users SET firstname='$firstname', lastname='$lastname', gender='$gender', company='$company', workposition='$workposition', email='$email', website='$website', country='$country', city='$city', address='$address', phone='$phone', mobile=' $mobile', note='$note', category='$category', trn_date='$trn_date' WHERE id='$id'";
	         	$result = mysqli_query($conn, $query);

	         	 $poruka = "<div class=\"uspeh\">Korisniku " . $firstname . " " . $lastname . " sa mail adresom " . $email . " su uspesno promenjeni podaci!</div>";

				renderForm($id, $firstname, $lastname, $gender, $company, $workposition, $email, $website, $country, $city, $address, $phone, $mobile, $note, $category, $poruka); 
				 }

		 }
		 else
		 {
		 // if the 'id' isn't valid, display an error
		 echo 'Error!';
		 }
	 }
	 else
	 // if the form hasn't been submitted, get the data from the db and display the form
	 {
	 
	 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
	 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
	 {
		 // query db
		 $id = $_GET['id'];
		 $query = "SELECT * FROM tbl_users WHERE id=$id";
		 $result = mysqli_query($conn, $query);
		 
		 $row = mysqli_fetch_array($result);
		 
		 // check that the 'id' matches up with a row in the databse
		 if($row)
		 {	 
			 // get data from db
			 $firstname = $row['firstname'];
			 $lastname = $row['lastname'];
			 $gender = $row['gender'];
			 $company = $row['company'];
			 $workposition = $row['workposition'];
			 $email = $row['email'];
			 $website = $row['website'];
			 $country = $row['country'];
			 $city = $row['city'];
			 $address = $row['address'];
			 $phone = $row['phone'];
			 $mobile = $row['mobile'];
			 $note = $row['note'];
			 $category = $row['category'];

			 
			 // show form
			 renderForm($id, $firstname, $lastname, $gender, $company, $workposition, $email, $website, $country, $city, $address, $phone, $mobile, $note, $category, '');
		 }
		 else
		 // if no match, display result
		 {
		 	echo "No results!";
		 }
	 }
	 else
	 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
	 {
	 	echo 'Error!';
	 }
	 }
 }

?>