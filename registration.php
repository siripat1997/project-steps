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
				Username: <input type="text" name="username" placeholder="user001"><br>
				First Name: <input type="text" name="fname" placeholder="Mr. Harry"><br>
				Last Name: <input type="text" name="lname" placeholder="Potter"><br>
				Sex:<select name="sex">
					<option value="male"> Male </option>
					<option value="female"> Female </option>
				</select><br><br>
				Password: <input type="password" name="passwd" placeholder="*******"><br>
				Re-Type Password: <input type="password" name="repasswd" placeholder="*******" ><br>
				<input type="submit" value="Register" >
			</form>
			<a href='login.php'>back to login page</a>
			<?php
				if($_SESSION["member"]){
					header ("Location: secret.php"); 
				} 
				if(!(
					empty($_POST['username']) and 
					empty($_POST['fname']) and 
					empty($_POST['lname']) and 
					empty($_POST['sex']) and
					empty($_POST['passwd']) and
					empty($_POST['repasswd'])
				)){

					if($_POST['passwd'] == $_POST['repasswd']){
						$servername = "localhost";
						$username = "root";
						$password = "";
						$db = "mydb";

						$conn = new mysqli($servername, $username, $password ,$db);

						if ($conn->connect_error) {
					    	die("Connection failed: " . $conn->connect_error);
						} 

						$cmd = "INSERT INTO userlogin (username,passwd,fname,lname,sex) 
								VALUES ('".$_POST['username']."' , '".$_POST['passwd']."', '".$_POST['fname']."' , 
										'".$_POST['lname']."', '".$_POST['sex']."')" ;

						if ($conn->query($cmd) === TRUE) {
					   		echo "<script type='text/javascript'>alert('Success!');</script>";
					    }else{
					    	echo "Error: " . $cmd . "<br>" . $conn->error;
						}

						$conn->close();
					}else{
						echo "Password is not matched. Please try again.";
					}
				}
			?>
		</center>
	</body>
</html>