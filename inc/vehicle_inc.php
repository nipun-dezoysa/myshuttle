<?php
    require_once("connection.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $number = mysqli_real_escape_string($connection,$_POST['number']);
        $seats = mysqli_real_escape_string($connection,$_POST['seats']);
        $model = mysqli_real_escape_string($connection,$_POST['model']);
        $air = mysqli_real_escape_string($connection,$_POST['air']);
        $name = mysqli_real_escape_string($connection,$_POST['name']);
        $nic = mysqli_real_escape_string($connection,$_POST['nic']);
        $contact = mysqli_real_escape_string($connection,$_POST['contact']);

        $res=mysqli_query($connection,"SELECT * FROM vehicle WHERE reg_num='".$number."'");

        if (mysqli_num_rows($res)>0){
			echo json_encode(array("statusCode"=>201));
		}
		else{
			if (mysqli_query($connection,"INSERT INTO vehicle(u_id,name,nic,reg_num,seats,model,air,contact) VALUES ('".$_SESSION["id"]."','".$name."','".$nic."','".$number."','".$seats."','".$model."','".$air."','".$contact."')")) {
                
				echo json_encode(array("statusCode"=>200));
			} 
			else {
				echo json_encode(array("statusCode"=>202));
			}
		}

        // if (mysqli_query($connection,"INSERT INTO vehicle(name,nic,reg_num,seats,model,air,contact) VALUES ('".$name."','".$nic."','".$number."','".$seats."','".$model."','".$air."','".$contact."')")) {
        //     echo json_encode(array("statusCode"=>200));
        // } 
        // else {
        //     echo json_encode(array("statusCode"=>202));
        // }
		mysqli_close($connection);
    
    }else{
        header('Location:../signin.php');
        exit();
    }
?>