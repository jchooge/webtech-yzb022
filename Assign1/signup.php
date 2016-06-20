<?php
		
	//start session
	session_start();	

	//get username and password from $_POST
	//here it should be sanitizing, but since that function is not working for the class right now I did not attach
	//it because i would rather it at least work for now.
	$username = $_POST["username"];
	$name = $_POST["name"];
	$password = $_POST["password"];
	$confirm = $_POST["confirm"];
	$birthday = $_POST["birthday"];
	$gender = $_POST["gender"];
	$email = $_POST["email"];
	$question = $_POST["question"];
	$answer = $_POST["answer"];
	$location = $_POST["location"];
	$picture = $_POST["picture"];

	if($password != $confirm) {
        echo "Password error: Password does not equal the confirmed password";
    }
    //check if password hash worked
    elseif (($pwh = password_hash($password, PASSWORD_BCRYPT)) == FALSE){
        echo "Password Error: please try again later";
    }

	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "myDB";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if( mysqli_connect_errno($conn)){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$sql = mysqli_query($conn, "INSERT INTO users(username, password, Name, verification_question, verification_answer, dob, location, profile_pic, email, gender) 
		VALUES ('$username', '$pwh', '$name', '$question', '$answer', '$birthday', '$location', '$picture', '$email', $gender)");
	//Check in the DB
	if($sql > 0) {

		//If authenticated: say hello!
		$_SESSION["username"] = $username;
		header("Location: feed.php");
		//echo "Success!! Welcome ".$username;

	} else {
		//else ask to login again..	
		echo "$username, $password, $name, $question, $answer, $birthday, $location, $picture, $email, $gender";

	}
?>