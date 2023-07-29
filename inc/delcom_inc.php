<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $coid = $_POST['coid'];
        if(mysqli_query($connection,"DELETE FROM comment WHERE co_id='".$coid."'")){
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