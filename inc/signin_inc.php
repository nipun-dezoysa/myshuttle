<?php
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $pass = mysqli_real_escape_string($connection,$_POST['password']);

        $query = "SELECT * FROM user WHERE email=?";
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt,$query)){
            echo json_encode(array("statusCode"=>202));
            exit();
        }
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        $emailres=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if (mysqli_num_rows($emailres)<1){
			echo json_encode(array("statusCode"=>201));
		}
		else{
            $row=mysqli_fetch_assoc($emailres);
            $hashedPass = $row['password'];
            if(password_verify($pass,$hashedPass)){
                session_start();
                $_SESSION["pass"] = $row["password"];
                $_SESSION["id"] = $row["u_id"];
				echo json_encode(array("statusCode"=>200));
            }else{
                echo json_encode(array("statusCode"=>202));
            }
		}
		mysqli_close($connection);
    }else{
        header('Location:../signin.php');
        exit();
    }
?>