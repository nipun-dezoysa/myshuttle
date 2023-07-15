<?php
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = mysqli_real_escape_string($connection,$_POST['name']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
		$phone = mysqli_real_escape_string($connection,$_POST['phone']);
        $pass = mysqli_real_escape_string($connection,$_POST['password']);

        $emailres=mysqli_query($connection,"SELECT * FROM user WHERE email='".$email."'");
        $phoneres=mysqli_query($connection,"SELECT * FROM user WHERE phone='".$phone."'");

		$error = 0;
		$prror = 0;

		if (mysqli_num_rows($phoneres)>0){
			$error=1;
		}
		if (mysqli_num_rows($emailres)>0){
			$prror=1;
		}

        if ($error!=0 || $prror!=0){
			if($error==1){
				if($prror==1){
					echo json_encode(array("statusCode"=>204));
				}else{
					echo json_encode(array("statusCode"=>201));
				}
			}else{
				echo json_encode(array("statusCode"=>202));
			}
		}
		else{
			if (mysqli_query($connection,"INSERT INTO user(f_name,email,password,phone) VALUES ('".$name."','".$email."','".$pass."','".$phone."')")) {
				echo json_encode(array("statusCode"=>200));
			} 
			else {
				echo json_encode(array("statusCode"=>203));
			}
		}
		mysqli_close($connection);
    }else{
        header('Location:../signup.php');
        exit();
    }
?>