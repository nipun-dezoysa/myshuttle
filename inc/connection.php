<?php 
	$connection = mysqli_connect('localhost','root','','myshuttle');

	if(mysqli_connect_errno()){
		die('Database Connection failed '. mysqli_connect_error());
	}else{
		//echo "Connection Success";
	}

?>