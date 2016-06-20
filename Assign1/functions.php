<?php
	function destroySession() {
    	$_SESSION=array();
    	//$_SESSION = [];
    
   	 if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    	session_destroy();
	}
	/*
	* currently this function does not return correctly so return the string as it is
	*/
	function sanitizeString($var){
		$var = strip_tags($var);
		$var = htmlentities($var);
		$var = stripslashes($var);
		return $var;
		//not sure why this wouldn't work, but simple return seems to work just fine for now
		//return mysqli_real_escape_string($var);
	}
?>