<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profile</title>

	<script src="https://kit.fontawesome.com/1a1e8427ab.js" crossorigin="anonymous"></script>
		
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  	
  	<style>
		body{
			background: url(images/ezgif.com-gif-maker.gif);
			color: aliceblue;
			margin-left: 3%;
			margin-top: -1%;
			width: auto;
			overflow-x: hidden;
		}
		.profilepic{
			align-content: center;
			border-radius: 100px;
		}
		.center{
			align-content: center;
			text-align: center;
		}
		.right{
			text-align: right;
		}
		.editButton{
			color: black;
			font-size: 1.75em;
			border-radius: 70px;
			text-align: center;
			width: 60%;
			margin-left: 68%;
			margin-top: 20%;
		}

		.details{
			margin-left: -220px;
		}

		.container {
		  position: relative;
		  width: 50%;
		}

		.image {
		  opacity: 1;
		  display: block;
	/*		  width: 100%;*/
	/*		  height: auto;*/
		  transition: .5s ease;
		  backface-visibility: hidden;
		}

		.middle {
		  transition: .5s ease;
		  opacity: 0;
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  transform: translate(-50%, -50%);
		  -ms-transform: translate(-50%, -50%);
		  text-align: center;
		}

		.container:hover .image {
		  opacity: 0.6;
		}

		.container:hover .middle {
		  opacity: 1;
		}

		.text {
		  background-color: transparent;
		  color: white;
		  margin-left: 25px;
		  font-size: 18px;
		  padding: 20px;
		}

		.buttonPic{
			border-radius: 50px;
			background-color: black;
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
		
		table {
		  border-collapse: collapse;
		  width: 40%;
		}
		
		th, td {
		  padding: 11px;
		  text-align: center;
		  border-bottom: 1px solid #ddd;
		  font-size: 1.25em;
		  color: lightgoldenrodyellow;
		}

		tr:nth-child(even) {background-color: black;}
		
		th{
			text-align: left;
			font-size: 1.33em;
/*			background-color: black;*/
		}
		
		tr:hover {
			background-color: grey;
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

			
	<?php
		$email = $name = $phone = $state = $city = $address = "";
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
	
		$detail = mysql_query("select name, phone, address, state, city, profilepic from user where email = '$email'");
		$row = mysql_fetch_assoc($detail);
		
		$name = $row["name"];
		$phone = $row["phone"];
		$state = $row["state"];
		$city = $row["city"];
		$address = $row["address"];
		$profilepic = $row["profilepic"];

	?>
		
	<div class="row">
<!--		Name-->
		<div class="col-md-4">
			<br>
			<?php echo "<h1 style='color: lightgoldenrodyellow; margin-top: 10%; margin-left: 3%; font-size: 3.75em;'>Hello, $name</h1>"; ?>
		</div>
		
<!--		Profile Pic-->
		<div class="col-md-4 center">
			<?php
				echo'
						<br><br>
						<div class="container">
							<img src="data:image/jpeg;charset=utf-8;base64,'.base64_encode($row['profilepic'] ).'" height="200px" width="200px" class="image profilepic" />
							<div class="middle">
								<div class="text"><button class="btn btn-info buttonPic">Change</button></div>
						    </div>
						 </div> 
						<br><br><br><br>
				';
			?>
		</div>
		
<!--		update profile button-->
		<div class="col-md-2 right">
<!--			Button-->
			<br><br>
			<center>
				<button class="editButton">Edit</button>
			</center>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4">
		
			  <h2 style="margin-left: 6.25%;">Add Wardrobe</h2>
			  <form action="postform.php">
			  	<button type="submit" class="btn btn-info btn-lg editButton" style="margin-top: 0%; margin-left: 0%; background: silver; color: black;" >Add</button>
		 	  </form>

		</div>
		
		<div class="col-md-8 center details">
		
			<center>
				<table>
					<tr>
						<th>
							Name:
						</th>

						<td>
							<?php echo $name; ?>
						</td>
					</tr>

					<tr>
						<th>
							Phone:
						</th>

						<td>
							<?php echo $phone; ?>
						</td>
					</tr>

					<tr>
						<th>
							E-mail:
						</th>

						<td>
							<?php echo $email; ?>
						</td>
					</tr>

					<tr>
						<th>
							State:
						</th>

						<td>
							<?php echo $state; ?>
						</td>
					</tr>

					<tr>
						<th>
							City:
						</th>

						<td>
							<?php echo $city; ?>
						</td>
					</tr>

					<tr>
						<th>
							Adress:
						</th>

						<td>
							<?php echo $address; ?>
						</td>
					</tr>

				</table>
			</center> 				
		</div>

	</div>	

	<ul>
	  <li><a href="wall.php" style="font-size: 1.35em;">&nbsp;&nbsp;Wall&nbsp;&nbsp;</a></li>
	  <li><a class="active" style="font-size: 1.35em;" href="profile.php">Profile</a></li>
	</ul>
</body>
</html>