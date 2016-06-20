<?php
    header("Location: feed.php");
    session_start();
    include('database.php');
    $content = $_POST['content'];
    $UID = $_POST['UID'];
    $conn = connect_db();
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$UID'");
    $row = mysqli_fetch_assoc($result);
    //fetch user info
    $name = $row["Name"];
    $profile_pic = $row["profile_pic"];
    $result_insert = mysqli_query($conn, "INSERT INTO Post(content, UID, name, profile_pic, likes) VALUES ('$content', $UID, '$name', '$profile_pic', 0)");
    //check if result saved into the DB
	if($result_insert) {
		//redirect to feed page 
		//header("Location: feed.php");
	} else {
		//throw an error	
		echo "Oops! Something went wrong! Please try again!";
	}
?>