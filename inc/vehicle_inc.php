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

        $res=mysqli_query($connection,"SELECT * FROM vehicle WHERE reg_num='".$number."' AND u_id!='".$_SESSION["id"]."'");

        if (mysqli_num_rows($res)>0){
			echo json_encode(array("statusCode"=>201));
		}
		else{
            //user ma add karapu thawa vehicle ekak thiyenawada check kirima
            $exist=mysqli_query($connection,"SELECT * FROM vehicle WHERE reg_num='".$number."' AND u_id='".$_SESSION["id"]."'");
            if (mysqli_num_rows($exist)>0){
                $update=mysqli_fetch_assoc($exist);
                if (mysqli_query($connection,"UPDATE vehicle SET name='".$name."', nic='".$nic."', seats='".$seats."', model='".$model."', air='".$air."', contact='".$contact."' WHERE u_id='".$update['u_id']."'")) {
                
                    echo json_encode(array("statusCode"=>200));
                } 
                else {
                    echo json_encode(array("statusCode"=>202));
                }
            }
			else{
                if (mysqli_query($connection,"INSERT INTO vehicle(u_id,name,nic,reg_num,seats,model,air,contact) VALUES ('".$_SESSION["id"]."','".$name."','".$nic."','".$number."','".$seats."','".$model."','".$air."','".$contact."')")) {
                
                    echo json_encode(array("statusCode"=>200));
                } 
                else {
                    echo json_encode(array("statusCode"=>202));
                }
            }
		}
		mysqli_close($connection);
    
    }else{
        header('Location:../signin.php');
        exit();
    }
?>