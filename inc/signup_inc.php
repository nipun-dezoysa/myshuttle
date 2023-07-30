<?php
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = mysqli_real_escape_string($connection,$_POST['name']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
		$phone = mysqli_real_escape_string($connection,$_POST['phone']);
        $pass = mysqli_real_escape_string($connection,$_POST['password']);

		$query1 = "SELECT * FROM user WHERE email=?;";
		$stmt1 = mysqli_stmt_init($connection);
		if(!mysqli_stmt_prepare($stmt1,$query1)){
			echo json_encode(array("statusCode"=>203));
			exit();
		}
		mysqli_stmt_bind_param($stmt1,"s",$email);
		mysqli_stmt_execute($stmt1);
		$emailres=mysqli_stmt_get_result($stmt1);
		mysqli_stmt_close($stmt1);

		$query2 = "SELECT * FROM user WHERE phone=?";
		$stmt2 = mysqli_stmt_init($connection);
		if(!mysqli_stmt_prepare($stmt2,$query2)){
			echo json_encode(array("statusCode"=>203));
			exit();
		}
		mysqli_stmt_bind_param($stmt2,"s",$phone);
		mysqli_stmt_execute($stmt2);
		$phoneres=mysqli_stmt_get_result($stmt2);
		mysqli_stmt_close($stmt2);

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
			$query3 = "INSERT INTO user(f_name,email,password,phone) VALUES (?,?,?,?)";
			$stmt3 = mysqli_stmt_init($connection);
			if(!mysqli_stmt_prepare($stmt3,$query3)){
				echo json_encode(array("statusCode"=>203));
				exit();
			}
			$hashedPass = password_hash($pass,PASSWORD_DEFAULT);
			mysqli_stmt_bind_param($stmt3,"ssss",$name,$email,$hashedPass,$phone);
			mysqli_stmt_execute($stmt3);
			mysqli_stmt_close($stmt3);
			echo json_encode(array("statusCode"=>200));
		}
		mysqli_close($connection);
    }else{
        header('Location:../signup.php');
        exit();
    }
?>