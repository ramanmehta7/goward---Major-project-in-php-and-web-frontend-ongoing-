<!DOCTYPE HTML>  
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Mansalva|Montserrat&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/1a1e8427ab.js" crossorigin="anonymous"></script>
	
<!--
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
-->

<style>

	body{
		margin-left: 5%;
		background: url("images/boutique-close-up-closet-2249248.jpg");
		background-size: 100% 100%;
		background-repeat: no-repeat;
	}	

	#anim {
	  width: 110px;
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
	.submitButton{
		background-color: #4CAF50;
		border: none;
		color: white;
		padding: 11px 11px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		border-radius: 10px;
	}
	
	html {
		 height: 100%;
	}
	 body {
		 background-color:#2590EB;
		 height: 100%;
	}
	 .wrapper {
		 background: transparent;
		 width: 100%;
		 height: 100%;
		 display: flex;
		 align-items: center;
		 justify-content: center;
	}
	 .wrapper .file-upload {
		 height: 150px;
		 width: 150px;
		 border-radius: 100px;
		 position: relative;
		 display: flex;
		 justify-content: center;
		 align-items: center;
		 border: 4px solid #fff;
		 overflow: hidden;
		 background: transparent;
		 background-image: linear-gradient(to bottom, #2590eb 50%, #fff 50%);
		 background-size: 100% 200%;
		 transition: all 1s;
		 color: #fff;
		 font-size: 100px;
	}
	 .wrapper .file-upload input[type='file'] {
		 height: 150px;
		 width: 150px;
		 position: absolute;
		 top: 0;
		 left: 0;
		 opacity: 0;
		 cursor: pointer;
	}
	 .wrapper .file-upload:hover {
		 background-position: 0 -100%;
		 color: #2590eb;
	}


</style>
	<script src="javaScript/cities.js"></script>
</head>
<body>


<?php
// define variables and set to empty values
$nameErr = $emailErr = $passErr = $repassErr = $locErr = $contErr = $stateErr = $cityErr = "";
$name = $email = $loc = $state = $city = $cont = "";
$pass = $repass = "";
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
   
	
	$servername = "localhost";
	$username = "root";
	$password = "dell";
	$database = "goward";

	$conn = mysql_connect($servername, $username, $password);
	mysql_select_db($database, $conn);
	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<!--
<center>
 <div><h1 id="anim" style="color: black; width: 110px; opacity: 0.7;"><center>Sign up</center></h1></div>
</center>
-->
<p><span class="error"></span></p>
<form method="post" id="usrform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	
	<div class="wrapper">
	  <div class="file-upload">
		<input type="file" name="image" id="image"/>
		<i class="fas fa-shopping-bag"></i>
	  </div>
	</div>
	<br>
	
	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.55;">Name:</span></strong> &nbsp; <input type="text" name="fname" style="width: 33%;">
      <span class="error"> <?php echo $nameErr;?></span>
      <br><br>  

	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.55;" >E-mail:</span></strong> &nbsp; <input type="email" name="email" style="width: 30%;">
      <span class="error"> <?php echo $emailErr;?></span>

      <br><br>
	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.55;">Contact Number:</span></strong> &nbsp; <input type="tel" name="cont" style="width: 30%;">
      <span class="error"> <?php echo $contErr;?></span>
      <br><br>

	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.55;">Password:</span></strong> &nbsp;
      <input type="password" id="psw" name="psw" style="width: 28%;" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
      <span class="error"> <?php echo $passErr;?></span>

		<div id="message">
		<!--  <h3>Password must contain the following:</h3> -->
			<p id="letter" class="invalid"><b>A lowercase letter</b></p>
			<p id="capital" class="invalid"><b>A Uppercase letter</b></p>
			<p id="number" class="invalid"><b>A number</b></p>
			<p id="length" class="invalid"><b>Minimum 8 characters</b></p>
		</div>

      &nbsp;
	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.7;">Repeat:</span></strong> &nbsp; <input type="password" name="repass" style="width: 28%;">
      <span class="error"> <?php echo $repassErr;?></span>
      <br><br>

	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.55;">State:</span></strong> &nbsp;
     <select onchange="print_city('state', this.selectedIndex);" id="sts" name="stt" class="form-control" required></select>
      <span class="error"> <?php echo $stateErr;?></span>
      &nbsp; &nbsp; &nbsp; &nbsp;

	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.7;">City:</span></strong> &nbsp;
	<select id="state" name="city" class="form-control" required></select>
	<span class="error"> <?php echo $cityErr;?> </span>
	<script language="javascript">print_state("sts");</script>
      <br><br>

	<strong><span class="spanSize" style="color: white; background-color: black; opacity: 0.55;">Address:</span></strong> &nbsp; <textarea rows="3" cols="40" name="address" form="usrform"></textarea>
      <span class="error"> <?php echo $locErr;?></span>
      <br><br>
    	
    <center>
      <input class="submitButton" type="submit" id="insert" style="width" name="submit">
	</center>
</form>

<center>
<h2 style="color: black; background-color: white;"><b>Already a Member? </b><a href = "http://localhost/goward/signin.php">Log-In</a></h2>
</center>
<!--

<footer style="background-color: black; color: white;">
	<h2 style="margin-left: 3%; font-size: 1.90em; color: lightgoldenrodyellow; font-family: 'Montserrat', sans-serif;">&copy; goward</h2>
</footer>
-->
<!--	<div style= "background-color: black;  color: white;">Gowards</h2></div>-->

<script>  
 $(document).ready(function(){
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>

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
			if ($_FILES['image']['size'] == 0 && $_FILES['image']['error'] == 0) {
				$file = addslashes(file_get_contents("images/avatar-1577909_1280.png"));
			} else {
				$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
				echo $file;
			}
			mysql_query("INSERT INTO user (name,phone,email,password,address,state,city,profilepic) VALUES ('$name','$cont','$email','$pass','$loc','$state','$city','$file')");

			echo '<script type"text/javascript"> alert("Data Stored Successfully");</script>';
			echo "<script type='text/javascript'>window.location='http://localhost/goward/signin.php';</script>";
		}
		mysql_close($conn);

   }
?>

</body>
</html>