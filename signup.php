<!DOCTYPE HTML>  
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Mansalva|Montserrat&display=swap" rel="stylesheet">
<style>

#anim {
  width: 250px;
  height: 40px;
  background-color: red;
  -webkit-animation-name: example; /* Safari 4.0 - 8.0 */
  -webkit-animation-duration: 4s; /* Safari 4.0 - 8.0 */
  animation-name: example;
  animation-duration: 4s;
    animation-iteration-count: infinite;

}

/* Safari 4.0 - 8.0 */
@-webkit-keyframes example {
  from {background-color: red;}
  to {background-color: yellow;}
}

/* Standard syntax */
@keyframes example {
  from {background-color: red;}
  to {background-color: yellow;}
}



/* Style all input fields */
input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Style the submit button */
input[type=submit] {
  background-color: #4CAF50;
  color: white;
}

/* Style the container for inputs */
.container {
  background-color: #f1f1f1;
}
	
/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
}

#saveForm{
	position : relative;
	left : 400px;
	
}

#message p {
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "OK";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "X";
}
.error {color: #FF0000;}
input{
	width : 15%;
}

.spanSize{
	color: black;
	font-family: 'Montserrat', sans-serif;
}
</style>
	<script src="cities.js"></script>
</head>
<body background="images/assorted-blurred-background-boutique-994523.jpg" style="background-size: 100% 100%; background-repeat: no-repeat;">

<?php
// define variables and set to empty values
$nameErr = $emailErr = $passErr = $repassErr = $locErr = $contErr = $stateErr = $cityErr = "";
$name = $email = $loc = $state = $city = $cont = "";
$pass = $repass = "a";
$count=0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["fname"])) {
    $nameErr = "First Name is required";
  } else {
    $name = test_input($_POST["fname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    } else {
		$count++;
	}
  }

  if (empty($_POST["stt"])) {
    $stateErr = "State name is required";
  } else {
    $state = test_input($_POST["stt"]);
	$count++;
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }else {
		$count++;
	}
  }
    
  if (empty($_POST["psw"])) {
    $passErr = "Password is required";
  } else {
	  $count++;
    $pass = $_POST["psw"];
  }

 if (empty($_POST["repass"])) {
    $repassErr = "Re-Enter your Password";
  } else {
	  $count++;
    $repass = $_POST["repass"];
  }
  
  if (empty($_POST["address"])) {
    $locErr = "Address is required";
  } else {
    $loc = test_input($_POST["address"]);
	$count++;
  }
  
  if (empty($_POST["cont"])) {
    $contErr = "Contact Number is required";
  } else {
    $cont = test_input($_POST["cont"]);
	if (!preg_match("/^([+][9][1]|[9][1]|[0]){0,1}([7-9]{1})([0-9]{9})$/",$cont)) {
		$contErr = "Indian numbers only";
    }else {
 		$count++;
	}
  }

  if (empty($_POST["city"])) {
    $cityErr = "City is required";
  } else {
	  $city = test_input($_POST["city"]);
 	  $count++;
  }

  if($pass != $repass){
	  	$count++;
	    echo '<script type"text/javascript"> alert("Password does not match");</script>';	
   }
   
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<center>
 <div id="anim"><h1><center>Get your Access :)</center></h1></div>
</center>
<p><span class="error"></span></p>
<form method="post" id="usrform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.45;">Name:</span></strong> &nbsp; <input type="text" name="fname" style="width: 33%;">
      <span class="error"> <?php echo $nameErr;?></span>
      <br><br>  

	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.45;" >E-mail:</span></strong> &nbsp; <input type="email" name="email" style="width: 30%;">
      <span class="error"> <?php echo $emailErr;?></span>

      <br><br>
	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.45;">Contact Number:</span></strong> &nbsp; <input type="tel" name="cont" style="width: 30%;">
      <span class="error"> <?php echo $contErr;?></span>
      <br><br>

	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.45;">Password:</span></strong> &nbsp;
      <input type="password" id="psw" name="psw" style="width: 21%;" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
      <span class="error"> <?php echo $passErr;?></span>

		<div id="message">
		<!--  <h3>Password must contain the following:</h3> -->
			<p id="letter" class="invalid"><b>A lowercase letter</b></p>
			<p id="capital" class="invalid"><b>A Uppercase letter</b></p>
			<p id="number" class="invalid"><b>A number</b></p>
			<p id="length" class="invalid"><b>Minimum 8 characters</b></p>
		</div>

      &nbsp;
	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.6;">Repeat Password:</span></strong> &nbsp; <input type="password" name="repass" style="width: 21%;">
      <span class="error"> <?php echo $repassErr;?></span>
      <br><br>

	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.45;">State:</span></strong> &nbsp; <select onchange="print_city('state', this.selectedIndex);" id="sts" name="stt" class="form-control" required></select> 
      <span class="error"> <?php echo $stateErr;?></span>
      &nbsp; &nbsp; &nbsp; &nbsp;

	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.6;">City:</span></strong> &nbsp; <select id="state" name="city" class="form-control" required></select>
	  <span class="error"> <?php echo $cityErr;?> </span>
	  <script language="javascript">print_state("sts");</script>
      <br><br>

	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.45;">Address:</span></strong> &nbsp; <textarea rows="4" cols="50" name="address" form="usrform"></textarea>
      <span class="error"> <?php echo $locErr;?></span>
      <br><br>
    	
    <center>
      <input type="submit" style="width" name="Submit">
	</center>
</form>

<center>
<h2 style="color: black; background-color: white;"><b>Already a Member? </b><a href = "http://localhost/Food%20Ordering/login.php">Log-In</a></h2>
</center>

<footer style="background-color: black; color: white;">
	<h2 style="margin-left: 3%; font-size: 1.90em; color: lightgoldenrodyellow; font-family: 'Montserrat', sans-serif;">&copy; goward</h2>
</footer>
<!--	<div style= "background-color: black;  color: white;">Gowards</h2></div>-->
<script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>

<?php
   if($count=="8")
   {
	    $servername = "localhost";
		$username = "root";
		$password = "dell";
		$database = "goward";

		// Create connection
		$conn = mysql_connect($servername, $username, $password);
		mysql_select_db($database, $conn);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$pass = md5($pass);
		
       $sql = mysql_query("select * from user where email = '$email'", $conn);
		if(mysql_num_rows($sql) > 0){
			echo '<script type"text/javascript"> alert("This E-mail already exists");</script>';
			$count++;
		}

		if($count == "8")
		{
			mysql_query("INSERT INTO user (name,phone,email,password,address,state,city) VALUES ('$name','$cont','$email','$pass','$loc','$state','$city')");
			echo '<script type"text/javascript"> alert("Data Stored Successfully");</script>';
		}
		mysql_close($conn);

   }
?>

</body>
</html>