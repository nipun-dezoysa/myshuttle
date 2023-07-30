<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $query1 = "INSERT INTO contact(name,email,message) VALUES (?,?,?);";
        $stmt1 = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt1,$query1)){
            echo json_encode(array("statusCode"=>201));
            exit();
        }
        mysqli_stmt_bind_param($stmt1,"sss",$name,$email,$message);
        
        if(mysqli_stmt_execute($stmt1)){
            echo json_encode(array("statusCode"=>200));
        }
        else{
            echo json_encode(array("statusCode"=>201));
        }
        mysqli_stmt_close($stmt1);
		mysqli_close($connection);
    }else{
        header('Location:../dashboard.php');
        exit();
    }
?>