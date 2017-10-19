<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<center>
			<br><br><br><br><br><br><br><br><br><br><br>

			<?php
				if(!$_SESSION['member']){
					header("Location: login.php");
				}
					
				else{
					$servername = "localhost";
					$username = "root";
					$password = "";
					$db = "mydb";

					$conn = new mysqli($servername, $username, $password, $db);

					if ($conn->connect_error) {
				    	die("Connection failed: " . $conn->connect_error);
					} 

					$show_info = "SELECT * FROM userlogin";
					$result = $conn->query($show_info);

					if ($result->num_rows > 0) {
					    echo "<table><tr><th>First Name</th><th>Last name</th><th>Sex</th><th>Username</th></tr>";
					    while($row = $result->fetch_assoc()) {
					        echo "<tr>
					        		<td>" . $row["fname"]. " </td>
					        		<td>" . $row["lname"]. "</td>
					        		<td>". $row["sex"]. "</td>
					        		<td>" . $row["username"]. "</td>
					        		</tr>";
				    	}
					} else {
					    echo "0 results";
					}
					$conn->close();
				}
			?>
			<caption align='bottom'>
				<form action='login.php' method="post">
					<input type="submit" name="logout" value="Logout">
				</form>
			</caption>
		</center>
	</body>
</html>