<?php 
require('db.php');
$conn->query("SET NAMES 'utf8'");
 // If form submitted, insert values into the database.
 if (isset($_POST['submit'])){

 	function strip($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	 return $data;
	}

	 $firstname = $_POST['firstname'];
	 $lastname = $_POST['lastname'];
	 $gender = $_POST['gender'];
	 $company = $_POST['company'];
	 $workposition = $_POST['work-position'];
	 $country = $_POST['country'];
	 $city = $_POST['city'];
	 $phone = $_POST['phone'];
	 $website = $_POST['web-site'];
	 $status = $_POST['status'];
	 $username = $_POST['username'];
	 $email = $_POST['email'];
	 $password = $_POST['password'];
	 $question = $_POST['question'];


	 /*$firstname = stripslashes($firstname);
	 $lastname = stripslashes($lastname);
	 $gender = stripslashes($gender);
	 $company = stripslashes($company);
	 $workposition = stripslashes($workposition);
	 $country = stripslashes($country);
	 $city = stripslashes($city);
	 $phone = stripslashes($phone);
	 $website = stripslashes($website);
	 $status = stripslashes($status);
	 $username = stripslashes($username);
	 $email = stripslashes($email);
	 $password = stripslashes($password);
	 $question = stripslashes($question);*/

	 $firstname = strip($firstname);
	 $lastname = strip($lastname);
	 $gender = strip($gender);
	 $company = strip($company);
	 $workposition = strip($workposition);
	 $country = strip($country);
	 $city = strip($city);
	 $phone = strip($phone);
	 $website = strip($website);
	 $status = strip($status);
	 $username = strip($username);
	 $email = strip($email);
	 $password = strip($password);
	 $question = strip($question);

	 $trn_date = date("Y-m-d H:i:s");
	 
	 //Slanje podataka na mail

	 //Email information
	  $admin_email = "asajfar@gmail.com, bojana.rudic@gmail.com";
	  $subject = "Registration from ts-expo.rs";

	  # MAIL BODY
	 
	  $body .= "Registration date: " . date("d.m.Y.") . " \n";
	  $body .= "First name: ".$_REQUEST['firstname']." \n";
	  $body .= "Last name: ".$_REQUEST['lastname']." \n";
	  $body .= "Gender: ".$_REQUEST['gender']." \n";
	  $body .= "Company: ".$_REQUEST['company']." \n";
	  $body .= "Work position: ".$_REQUEST['work-position']." \n";
	  $body .= "Country: ".$_REQUEST['country']." \n";
	  $body .= "City: ".$_REQUEST['city']." \n";
	  $body .= "Phone: ".$_REQUEST['phone']." \n";
	  $body .= "Web site: ".$_REQUEST['web-site']." \n";
	  $body .= "I am: ".$_REQUEST['status']." \n";	  
	  $body .= "User name: ".$_REQUEST['username']." \n";
	  $body .= "Email: ".$_REQUEST['email']." \n";
	  $body .= "Question: ".$_REQUEST['question']." \n";
	  

	  $headers = "From: administrator@ts-expo.rs";
							  
	  //send email
	  mail($admin_email, $subject, $body, $headers);


	 //Upis podataka u bazu
	 $query = "INSERT INTO tbl_applicants (firstname, lastname, gender, company, workposition, country, city, phone, website, status, username, email, password, question, trn_date) VALUES ('$firstname', '$lastname', '$gender', '$company', '$workposition',  '$country', '$city', '$phone', '$website', '$status', '$username', '$email', '".md5($password)."', '$question', '$trn_date')";
	 $result = mysqli_query($conn, $query);
	 if($result){
	 	header("Location: ../successreg.html"); // redirektovati na successreg.php gde ce biti obavestenje o tome i dalji linkovi ka pocetnoj strani ili logovanju
	 	exit();
 	}
 }else{
 	echo "<div class='form'><h3>You are not registered, try again.</h3><br/>Click here to <a href='../index.html'>register again</a></div>";
 }
?>


