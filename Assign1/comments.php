<?php
	header("Location: feed.php");
	//adding header function to top of the file to make it work. does not redirect 
	include('database.php');
	include('functions.php');
	session_start();
	//get the content and IDs associated with the comment
	$content = sanitizeString($_POST['content']);
	$UID = sanitizeString($_POST['UID']);
	$PID = sanitizeString($_POST['PID']);
	//connect to DB
	$conn = connect_db();
	if ($conn == 0){
		echo "error with DB";
	}
	$result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$UID'");
	$row = mysqli_fetch_assoc($result);
	//fetch user info
	$name = $row["Name"];
	$profile_pic = $row["profile_pic"];
	//insert into posts database
	$result_insert = mysqli_query($conn, "INSERT INTO comments (id, content, UID, name, profile_pic, likes, PID) VALUES (NULL, '$content', '$UID', '$name', '$profile_pic', 0, $PID)");
	if($result_insert) {
		//redirect to feed page (but this still does not work for me, that is why i put it at the top)
		header("Location: feed.php");
	}
	else {
		//error
		//currently won't show because the header function is at the top, used when debugging though
		echo "$name, $content, $UID, $PID";
	}
?>