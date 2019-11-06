<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Post Form</title>
		
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/1a1e8427ab.js" crossorigin="anonymous"></script>
			
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  	
  	<style>
		body{
			background: blue;
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
		
				ul {
		  list-style-type: none;
		  margin: 0;
		  padding: 0;
		  overflow: hidden;
		  background-color: #333;
		  position: fixed;
		  bottom: 0;
		  width: auto;
		  margin-left: 40%;
		}

		li {
		  float: left;
		}

		li a {
		  display: block;
		  color: white;
		  text-align: center;
		  padding: 14px 16px;
		  text-decoration: none;
		}

		li a:hover:not(.active) {
		  background-color: #111;
		}

		.active {
		  background-color: #4CAF50;
		}


	</style>

</head>
<body>

	<?php
		$email = $name = $phone = "";

		if (isset($_SESSION['email'])) {
			$email = $_SESSION["email"];
		} else {
			echo "No profile..";
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

		$detail = mysql_query("select name, phone from user where email = '$email'");
		$row = mysql_fetch_assoc($detail);

		$name = $row["name"];
		$phone = $row["phone"];

	?>
	<div style="background: white;">
		<br><br>
		<h2 class="modal-title" style="color: black; text-align: center;">Add here</h2>
	</div>
 	
 	
  	<br><br>
	  <form method="post" id="usrform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">

		<div class="wrapper">
		  <div class="file-upload">
			<input type="file" name="image" id="image"/>
			<i class="fas fa-shopping-bag"></i>
		  </div>
		</div>

		<br>
		<center>	
			<strong><span class="spanSize" style="color: white; background-color: black; margin-left: -2%;">Name:</span></strong> &nbsp; <input type="text" name="name" style="width: 20%">
			<br><br>

			<strong><span class="spanSize" style="color: white; background-color: black;">About:</span></strong> &nbsp; <textarea rows="3" cols="40" name="about" form="usrform"></textarea>

			<br><br>

			<input class="btn btn-info btn-lg" type="submit" id="insert" style="width" name="submit">
		</center>
	  </form>
	  <br><br>
	  <div style="background: white; height: 142px;"></div>

		<?php
			$postName = $about = "";
			$count = 0;

			if ($_SERVER["REQUEST_METHOD"] == "POST") {

				  if (empty($_POST["name"])) {
				  } else {
					$postName = test_input($_POST["name"]);
					$count++;
				  }
				
				  if (empty($_POST["about"])) {
					  
				  } else {
					$about = test_input($_POST["about"]);
					$count++;
				  }
			}

			function test_input($data) {
			  $data = trim($data);
			  $data = stripslashes($data);
			  $data = htmlspecialchars($data);
			  return $data;
			}
			
			if($count == "2"){
				$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
				mysql_query("INSERT INTO post (pic, email, phone, name, person, about) VALUES ('$file','$email','$phone','$postName','$name','$about')");

				echo '<script type"text/javascript"> alert("Post Uploaded");</script>';
				$count = 0;
			}
	
			mysql_close($conn);
		?>
		
	<ul>
	  <li><a class="active" href="wall.php" style="font-size: 2em;">&nbsp;&nbsp;Wall&nbsp;&nbsp;</a></li>
	  <li><a href="profile.php" style="font-size: 2em;">Profile</a></li>
	</ul>

</body>
</html>