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
			<form action="" method="post">

				Username: <input type="text" name="username" placeholder="step001"><br>

				Password: <input type="password" name="passwd" placeholder="*******" ><br>

				<input name="submit" type="submit" value="Login" >
			</form>
			
			<?php
				if(!empty($_POST["logout"])){
					$_SESSION["member"] = FALSE;
				}
				if($_SESSION['member'])
					header("Location: secret.php");
				else{
					$servername = "localhost";
					$username = "root";
					$password = "";
					$db = "mydb";

					$conn = new mysqli($servername, $username, $password ,$db);

					if ($conn->connect_error) {
			    		die("Connection failed: " . $conn->connect_error);
					}

					if (!empty ($_POST['username']) and !empty ($_POST['passwd'])){
						$check = "SELECT username,passwd FROM userlogin WHERE username='".$_POST['username']."' AND
							passwd='".$_POST['passwd']."'";
						$result = $conn->query($check);

							if($result->num_rows > 0){
								session_start();
								$_SESSION["member"] = TRUE;
								header("Location: secret.php");

							}else{
								echo "<font color='red'>Username/Password Incorrect!</font>";
							}
	
					}else if( !empty($_POST['submit']) ){
						echo "Invalid Username/Password.";
					}
				}
			?>
			<a href='registration.php'>register here</a>
		</center>
	</body>
</html>