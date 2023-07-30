<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])){
        $reid = $_POST['reid'];

        $query1 = "SELECT u_id FROM reply WHERE re_id=?";
        $stmt1 = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt1,$query1)){
            echo json_encode(array("statusCode"=>201));
            exit();
        }
        mysqli_stmt_bind_param($stmt1,"s",$reid);
        mysqli_stmt_execute($stmt1);
        $res=mysqli_stmt_get_result($stmt1);
        mysqli_stmt_close($stmt1);

        $ex=mysqli_fetch_assoc($res);

        if($ex['u_id']==$_SESSION["id"]){
            $query = "DELETE FROM reply WHERE re_id=?";
            $stmt = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt,$query)){
                echo json_encode(array("statusCode"=>201));
                exit();
            }
            mysqli_stmt_bind_param($stmt,"s",$reid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            
            echo json_encode(array("statusCode"=>200));
        }
		mysqli_close($connection);
    }else{
        header('Location:../index.php');
        exit();
    }
?>