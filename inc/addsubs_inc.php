<?php
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['emd'];

		$query1 = "SELECT * FROM subs WHERE email=?;";
		$stmt1 = mysqli_stmt_init($connection);
		if(!mysqli_stmt_prepare($stmt1,$query1)){
			echo json_encode(array("statusCode"=>203));
			exit();
		}
		mysqli_stmt_bind_param($stmt1,"s",$email);
		mysqli_stmt_execute($stmt1);
		$emailres=mysqli_stmt_get_result($stmt1);
		mysqli_stmt_close($stmt1);
		
		if (mysqli_num_rows($emailres)>0){
			echo json_encode(array("statusCode"=>203));
			exit();
		}
		else{
			$query3 = "INSERT INTO subs(email) VALUES (?)";
			$stmt3 = mysqli_stmt_init($connection);
			if(!mysqli_stmt_prepare($stmt3,$query3)){
				echo json_encode(array("statusCode"=>203));
				exit();
			}
			mysqli_stmt_bind_param($stmt3,"s",$email);
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