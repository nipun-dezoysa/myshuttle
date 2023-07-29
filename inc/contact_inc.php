<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        if(mysqli_query($connection,"INSERT INTO contact(name,email,message) VALUES ('".$name."','".$email."','".$message."')")){
            echo json_encode(array("statusCode"=>200));
        }
        else{
            echo json_encode(array("statusCode"=>201));
        }
		mysqli_close($connection);
    }else{
        header('Location:../dashboard.php');
        exit();
    }
?>