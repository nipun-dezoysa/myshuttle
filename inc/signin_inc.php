<?php
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $pass = mysqli_real_escape_string($connection,$_POST['password']);

        $emailres=mysqli_query($connection,"SELECT * FROM user WHERE email='".$email."'");

        if (mysqli_num_rows($emailres)<1){
			echo json_encode(array("statusCode"=>201));
		}
		else{
            $row=mysqli_fetch_assoc($emailres);
			if ($pass==$row["password"]) {
                session_start();
                $_SESSION["pass"] = $row["password"];
                $_SESSION["id"] = $row["u_id"];
				echo json_encode(array("statusCode"=>200));
			} 
			else {
				echo json_encode(array("statusCode"=>202));
			}
		}
		mysqli_close($connection);
    }else{
        header('Location:../signin.php');
        exit();
    }
?>