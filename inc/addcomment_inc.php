<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])){
        $rate = $_POST['rate'];
        $rid = $_POST['rid'];
        $msg = $_POST['msg'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d/m/Y h:i:s');


        $query = "INSERT INTO comment(r_id,u_id,dates,message,rating) VALUES (?,?,?,?,?)";
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt,$query)){
            header('Location:../signup.php');
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ssssi",$rid,$_SESSION['id'],$date,$msg,$rate);
        if(mysqli_stmt_execute($stmt)){
            echo json_encode(array("statusCode"=>200));
        }
        else{
            echo json_encode(array("statusCode"=>201));
        }
        mysqli_stmt_close($stmt);
		mysqli_close($connection);
    }else{
        header('Location:../index.php');
        exit();
    }
?>