<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $reid = $_POST['reid'];
        if(mysqli_query($connection,"DELETE FROM reply WHERE re_id='".$reid."'")){
            echo json_encode(array("statusCode"=>200));
        }
        else{
            echo json_encode(array("statusCode"=>201));
        }
		mysqli_close($connection);
    }else{
        header('Location:../index.php');
        exit();
    }
?>