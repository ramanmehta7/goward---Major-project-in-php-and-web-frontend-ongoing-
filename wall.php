<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Wall</title>
	
	<style>
		body {
			margin:0;
			background: url(images/2988cc53392cef4afbe8a4ee14760648.png);
			background-repeat: repeat;
			color: black;
			font-size: 1.8em;
			text-align: center;
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
/*		  margin-left: 40%;*/
		}
		
		.profilepic{
/*			align-content: center;*/
			border-radius: 100px;
		}

		.image {
		  opacity: 1;
/*		  display: block;*/
	/*		  width: 100%;*/
	/*		  height: auto;*/
		  transition: .5s ease;
		  backface-visibility: hidden;
		  margin-top: -15%;
		  margin-left: 70%;
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

		.div{
			margin-top: 5%;
		}
		
	</style>
</head>
<body>
	<?php
	
		$servername = "localhost";
		$username = "root";
		$password = "dell";
		$database = "goward";

		$conn = mysqli_connect($servername, $username, $password, $database);

		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
	
	
		$sql = "SELECT pic, email, phone, name, person, about FROM post";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo '<div class = "div">';
				echo $row["name"] . "<br>";
				echo $row["email"] . "<br>";
				echo $row["phone"] . "<br>";
				echo $row["person"] . "<br>";
				echo $row["about"] . "<br>";
				echo '</div>';
				echo'
					<br><br>
					<div class="container">
						<img src="data:image/jpeg;charset=utf-8;base64,'.base64_encode($row['pic'] ).'" height="350px" width="350px" class="image profilepic" />
					 </div> 
					<br><br><br><br>
				';
				
			}
		}

		mysqli_close($conn);
	?>
	
	<ul>
	  <li><a class="active" href="wall.php" style="font-size: 2em;">&nbsp;&nbsp;Wall&nbsp;&nbsp;</a></li>
	  <li><a href="profile.php" style="font-size: 2em;">Profile</a></li>
	</ul>

	
</body>
</html>