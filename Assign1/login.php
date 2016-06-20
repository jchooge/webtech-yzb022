<?php
	//start session
	session_start();	
	//get username and password from $_POST
	//also need to sanitize here when we get the proper way to use it with PHP new update
	$username = $_POST["username"];
	$password = $_POST["password"];
	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "myDB";
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if( mysqli_connect_errno($conn)){
	  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
	$userarray = mysqli_fetch_assoc($result);
	//Check in the DB
	if(password_verify($password, $userarray["Password"])) {
		//If authenticated: say hello!
		$_SESSION["username"] = $username;
		header("Location: feed.php");
		//echo "Success!! Welcome ".$username
	}else{
		
		echo "Invalid password! Try again!";
	}
?>