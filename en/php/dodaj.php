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
        <title>NS-EXPO Database</title>
        <link rel="stylesheet" href="baza.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" media="screen">
        <link rel="author" href="humans.txt">
    </head>
    <script>
      function goBack() {
          window.history.back();
      }
      </script>
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

    	<form class="form-horizontal" role="form" action="" method="POST">
    		<div class="form-group">
          <label  class="control-label" for="firstname">First name</label>
          <div class="polje">
              <input type="text" name="firstname" class="form-control" 
              id="firstname" placeholder="First name"/>
          </div>
        </div>
        <div class="form-group">
          <label  class="control-label" for="lastname">Last name</label>
          <div class="polje">
              <input type="text" name="lastname" class="form-control" 
              id="lastname" placeholder="Last name"/>
          </div>
        </div>
        <div class="form-group">
          <label  class="control-label" for="gender">Gender</label>
          <div class="polje">
            <label class="radio-inline"><input class="radioinput1" type="radio" name="gender" value="Male">Male</label>
            <label class="radio-inline"><input class="radioinput2" type="radio" name="gender" value="Female">Female</label>
          </div>
        </div>
        <div class="form-group">
          <label  class="control-label" for="company">Company</label>
          <div class="polje">
              <input type="text" name="company" class="form-control" 
              id="company" placeholder="Company"/>
          </div>
        </div>
        <div class="form-group">
          <label  class="control-label" for="workposition">Work Position</label>
          <div class="polje">
              <input type="text" name="workposition" class="form-control" 
              id="workposition" placeholder="Work Position"/>
          </div>
        </div>
        <div class="form-group">
          <label  class="control-label" for="email">Email</label>
          <div class="polje">
              <input type="email" name="email" class="form-control" 
              id="email" placeholder="Email"/>
          </div>
        </div>
        <div class="form-group">
          <label  class="control-label" for="website">Website</label>
          <div class="polje">
              <input type="website" name="website" class="form-control" 
              id="website" placeholder="Website"/>
          </div>
        </div>
        <div class="form-group">
          <label  class="control-label" for="country">Country</label>
          <div class="polje">
              <input type="country" name="country" class="form-control" 
              id="country" placeholder="Country"/>
          </div>
        </div>
        <div class="form-group">
          <label  class="control-label" for="city">City</label>
          <div class="polje">
              <input type="city" name="city" class="form-control" 
              id="city" placeholder="City"/>
          </div>
        </div>
        <div class="form-group">
          <label  class="control-label" for="address">Address</label>
          <div class="polje">
              <input type="address" name="address" class="form-control" 
              id="address" placeholder="Address"/>
          </div>
        </div>
        <div class="form-group">
          <label  class="control-label" for="phone">Phone</label>
          <div class="polje">
              <input type="phone" name="phone" class="form-control" 
              id="phone" placeholder="Phone"/>
          </div>
        </div>
        <div class="form-group">
          <label  class="control-label" for="mobile">Mobile</label>
          <div class="polje">
              <input type="mobile" name="mobile" class="form-control" 
              id="mobile" placeholder="Mobile"/>
          </div>
        </div>
        <div class="form-group">
          <label  class="control-label" for="note">Note</label>
          <div class="polje">
              <textarea rows="5" name="note" class="form-control" 
              id="note" placeholder="Note"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label  class="control-label" for="category">Category</label>
          <div class="polje">
              <input type="category" name="category" class="form-control" 
              id="category" placeholder="Category"/>
          </div>
        </div>
        <div class="form-group">
          <div class="dugmeform">
            <input type="submit" name="upis" class="btn btn-default" value="Dodaj u bazu"/>
          </div>
        </div>
    	</form>

    <?php 

    function strip($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
     return $data;
    }

    if (isset($_POST['upis'])) {
      
    
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $gender = $_POST['gender'];
      $company = $_POST['company'];
      $workposition = $_POST['workposition'];
      $email = $_POST['email'];
      $website = $_POST['website'];
      $country = $_POST['country'];
      $city = $_POST['city'];
      $address = $_POST['address'];
      $phone = $_POST['phone'];
      $mobile = $_POST['mobile'];
      $note = $_POST['note'];
      $category = $_POST['category'];

      $trn_date = date("Y-m-d H:i:s");

      if (!empty($_POST['firstname']) || !empty($_POST['lastname']) || !empty($_POST['gender']) || !empty($_POST['company']) || !empty($_POST['workposition']) || !empty($_POST['email']) || !empty($_POST['website']) || !empty($_POST['country']) || !empty($_POST['city']) || !empty($_POST['address']) || !empty($_POST['phone']) || !empty($_POST['mobile']) || !empty($_POST['note']) || !empty($_POST['category'])) 
      {
        //Upis podataka u bazu
         $query = "INSERT INTO tbl_users (firstname, lastname, gender, company, workposition, email, website, country, city, address, phone, mobile, note, category, trn_date) VALUES ('$firstname', '$lastname', '$gender', '$company', '$workposition', '$email', '$website', '$country', '$city', '$address', '$phone', '$mobile', '$note', '$category', '$trn_date')";
         $result = mysqli_query($conn, $query);
     
         echo  "<div class=\"uspeh\">Korisnik " . $firstname . " " . $lastname . " sa mail adresom " . $email . " je uspesno dodat u bazu podataka</div>";
        
      }
      else
      {
        echo "<div class=\"uslov\">Da bi dodali podatke potrebno je da bar jedno polje popunite!</div>";
      }
 
    }

  ?>

<?php endif; ?>
  </body>
</html>
