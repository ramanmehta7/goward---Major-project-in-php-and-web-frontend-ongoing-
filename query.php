<?php
	$servername = "localhost";
	$username = "root";
	$password = "dell";
	$database = "goward";

	$conn = mysql_connect($servername, $username, $password);
	mysql_select_db($database, $conn);

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = mysql_query("delete from post where email='ramanmehta833@gmail.com'");
	mysql_query($sql, $conn);
//	while($row = mysql_fetch_assoc($detail)){
//		echo $row["name"];
//		echo'
//			<img class="profilepic" src="data:image/jpeg;charset=utf-8;base64,'.base64_encode($row['profilepic'] ).'" height="200px" width="200px" class="img-thumnail" />
//		';
//	}
?>
