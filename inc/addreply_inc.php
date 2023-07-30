<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])){
        $coid = $_POST['coid'];
        $reply = $_POST['reply'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d/m/Y h:i:s');
        
        $query = "INSERT INTO reply(co_id,u_id,dates,message) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt,$query)){
            header('Location:../signup.php');
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ssss",$coid,$_SESSION['id'],$date,$reply);
        
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