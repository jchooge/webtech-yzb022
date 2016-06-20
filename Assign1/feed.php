<!DOCTYPE html>
<html>
	<head>
		<title>MyFacebook Feed</title>
	</head>
<body>
<style>
    body {
        background: beige }
    section {
        background: cyan;
        color: black;
        border-radius: 1em;
        padding: 1em;
        position: absolute;
        top: 0%;
        left: 40%;
        margin-right: -40%;
        transform: translate(-10%, -10%) }
  </style>
<?php
	include('database.php');
	//begin local session
	session_start();

	$conn = connect_db();
	//get username from current session variables
	$username = $_SESSION["username"];
	$result = mysqli_query($conn, "SELECT * FROM users WHERE Username='$username'");

	//user information 
	$row = mysqli_fetch_assoc($result);
	echo "<section>";
	echo "<h1>Welcome back ".$row['Name']."!</h1>";
	echo "<img src='".$row['profile_pic']."'>";
	echo "<hr>";
	echo "<form method='POST' action='posts.php'>";
	echo "<p><textarea name='content'>Say something...</textarea></p>";
	echo "<input type='hidden' name='UID' value='$row[id]'>";
	echo "<p><input type='submit'></p>";	
	echo "</form>";
	echo "<br>";
	//echo "</section>";

	$result_posts = mysqli_query($conn, "SELECT * FROM Post");
	$num_of_rows = mysqli_num_rows($result_posts);

	echo "<h2>My Feed</h2>";
	if ($num_of_rows == 0) {
		echo "<p>No new posts to show!</p>";
	}

	//show all posts on myfacebook
	//between each post, also allow user to put comments and display all comments with each post
	//---according to that individual post
	for($i = 0; $i < $num_of_rows; $i++){

		$row = mysqli_fetch_row($result_posts);
		//echo "<section>";
		echo "$row[5] said $row[2] ($row[3])";
		echo "<form action='likes.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'> <input type='submit' value='Like'></form>";
		echo "<br>";

		// form for comment, similar to post form
		echo "<form method='POST' action='comments.php'>
            <textarea name='content' placeholder='Add comment to $row[5]...'></textarea><br>
            <input type='hidden' name='PID' value='$row[0]'>
            <input type='hidden' name='UID' value='$row[1]'>
            <input type='submit' value='Comment'>
            </form>
            <br>";
        ///ORDER BY created_at DESC
        $my_result = mysqli_query($conn, "SELECT * FROM comments WHERE PID='$row[0]'");
        $rows = mysqli_num_rows($my_result);
        for ($j = 0; $j < $rows; $j++){
            $comments = mysqli_fetch_assoc($my_result);
            echo "$comments[name]: $comments[content]<br><br>";
        }
	}
	echo "</section>";
?>
</body>
</html>