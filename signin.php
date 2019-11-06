<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign-In</title>
	
	<link href="https://fonts.googleapis.com/css?family=Mansalva|Montserrat&display=swap" rel="stylesheet">
		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="javaScript/parallax.js"></script>
	
	<style>
		body{
			text-align: center;
			font-size: 1.1em;
			margin-top: -5%;
		}

		#anim {
		  background-color: red;
		  -webkit-animation-name: example;
		  -webkit-animation-duration: 4s;
		  animation-name: example;
		  animation-duration: 4s;
		  animation-iteration-count: infinite;
		}

		@-webkit-keyframes example {
		  from {background-color: red;}
		  to {background-color: yellow;}
		}

		@keyframes example {
		  from {background-color: red;}
		  to {background-color: yellow;}
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
	</style>
</head>
<body>
	<?php
		$email = $pass = "";
		$count = 0;
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  if (empty($_POST["email"])) {
				echo "<div style='background-color: black; color: white; width: 110px; position: absolute; top: 75%; opacity: 1.0; left: 42%;'>Enter E-mail.</div>";
			  } else {
				$email = test_input($_POST["email"]);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				  echo "<div style='background-color: black; color: white; width: 110px; position: absolute; top: 75%; opacity: 1.0; left: 42%;'>Invalid E-mail.</div>";
				}else {
					$count++;
				}
			  }

			 if (empty($_POST["pass"])) {
				echo "<div style='background-color: black; color: white; width: 180px; position: absolute; top: 78.3%; opacity: 1.0; left: 33.6%;'>Enter your password.</div>";
			  } else {
				  $count++;
				  $pass = $_POST["pass"];
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
		<div class="parallax-window" data-parallax="scroll" data-image-src="images/photo-1512436991641-6745cdb1723f.jpg" style="height: 800px; color: aliceblue; opacity: 0.65; background-color: black;">
		
			<div><h1 id="anim" style="width: 150px; color: black; position: absolute; margin-top: 20%; margin-left: 36%;"><center>Sign up</center></h1></div>
	
			<form method="post" id="usrform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

				<strong><span class="spanSize" style="color: white; background-color: black; position: absolute; margin-top: 66%; margin-left: -24%;" >E-mail: </span></strong> &nbsp; <input type="email" name="email" style="width: 41%; position: absolute; margin-top: 66%; margin-left: -9%;">
				<br><br>

				&nbsp;
				<strong><span class="spanSize head" style="color: white; background-color: black; position: absolute; margin-top: 66%; margin-left: -30%;">Password: </span></strong> &nbsp; <input type="password" name="pass" style="width: 40%; position: absolute; margin-top: 66%; margin-left: -9%;">
				<br><br><br>

				<input type="submit" class="submitButton" style="position: absolute; margin-top: 66%; margin-left: -4%;" name="submit">

				<br><br><br><br><br><br><br>

			</form>
			<h2 style="color: white; background-color: black; width: 70%; position: absolute; margin-top: 72%; margin-left: 19%;"><b>New to Goward? </b><a href = "http://localhost/goward/signup.php">Log-In</a></h2>
		</div>
	</center>

	<?php
		if($count == "2"){
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
			if(mysql_num_rows($sql) == 0){
				echo '<script type"text/javascript"> alert("User not found.");</script>';
				$count++;
			}
			
			if($count == "2")
			{
				$passDb = mysql_query("select password from user where email = '$email'", $conn);
				$row = mysql_fetch_assoc($passDb);
				if($pass == $row["password"]){
					$_SESSION["email"] = $email;
					echo "<script type='text/javascript'>parent.document.getElementById('fs').cols = '0%, 100%';</script>";
					echo "<script type='text/javascript'>top.location = 'http://localhost/goward/profile.php'</script>";
				}
				else {
					echo '<script type"text/javascript"> alert("Wrong Password");</script>';
				}
				
			}
			mysql_close($conn);
		}
	?>
	
</body>
</html>