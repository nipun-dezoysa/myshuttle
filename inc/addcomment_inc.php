<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $rate = $_POST['rate'];
        $rid = $_POST['rid'];
        $msg = $_POST['msg'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d/m/Y h:i:s');
        if(mysqli_query($connection,"INSERT INTO comment(r_id,u_id,dates,message,rating) VALUES ('".$rid."','".$_SESSION['id']."','".$date."','".$msg."','".$rate."')")){
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