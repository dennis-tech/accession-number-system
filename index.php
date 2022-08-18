<?php 

require_once 'config.php';

session_start();
// 
$fetchsql = "SELECT MAX(numbers_to) FROM storedata";
$fetchresult = mysqli_query($conn, $fetchsql);
		$lastrow = mysqli_fetch_array($fetchresult);

		// $_SESSION['numbers_to'] = $lastrow['numbers_to'];

$email = $password = $error = "";
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['loggedin'] = true;
		
		
		header("Location: main.php");
	} else {
		$error = "Email or Password is incorrect".mysqli_error($conn);
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Accession Card System - LogIn</title>
</head>
<body>
	
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;"> Accession Card System <br>Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password"  required>
			</div>
			<div class="input-group">
				<button type="submit" name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
		<div>
		<?php
		echo $lastrow[0];
		?>
	</div>
	</div>

</body>
</html>