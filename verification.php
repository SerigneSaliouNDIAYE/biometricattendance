<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'biometricattendace';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

if ($stmt = $con->prepare('SELECT idagent, password, prenom, fonction FROM agent WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	
if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password, $prenom, $fonction);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if ($_POST['password'] === $password&& $fonction=='agent') {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $prenom;
		$_SESSION['id'] = $id;
		//echo 'Welcome ' . $_SESSION['name']
		header('Location: ManageUsers2.php');
	} elseif($_POST['password'] === $password && $fonction=='admin'){
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $prenom;
		$_SESSION['id'] = $id;
		//echo 'Welcome ' . $_SESSION['name'] . '!';
		
		header('Location: ManageUsers.php');
		
		//Incorrect password
		//echo 'Incorrect username and/or password!'
	}
	
	else{
		header('Location: login.php');
	}
}  

	$stmt->close();
}
?>