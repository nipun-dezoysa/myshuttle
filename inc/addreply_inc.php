<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $coid = $_POST['coid'];
        $reply = $_POST['reply'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d/m/Y h:i:s');
        if(mysqli_query($connection,"INSERT INTO reply(co_id,u_id,dates,message) VALUES ('".$coid."','".$_SESSION['id']."','".$date."','".$reply."')")){
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