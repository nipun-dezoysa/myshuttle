<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])){
        $coid = $_POST['coid'];

        $query1 = "SELECT u_id FROM comment WHERE co_id=?";
        $stmt1 = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt1,$query1)){
            echo json_encode(array("statusCode"=>201));
            exit();
        }
        mysqli_stmt_bind_param($stmt1,"s",$coid);
        mysqli_stmt_execute($stmt1);
        $res=mysqli_stmt_get_result($stmt1);
        mysqli_stmt_close($stmt1);

        $ex=mysqli_fetch_assoc($res);
        if($ex['u_id']==$_SESSION["id"]){
            $query2 = "DELETE FROM comment WHERE co_id=?;";
            $stmt2 = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt2,$query2)){
                echo json_encode(array("statusCode"=>201));
                exit();
            }
            mysqli_stmt_bind_param($stmt2,"s",$coid);
            if(mysqli_stmt_execute($stmt2)){
                echo json_encode(array("statusCode"=>200));
            }
            else{
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_stmt_close($stmt2);
        }
        
		mysqli_close($connection);
    }else{
        header('Location:../index.php');
        exit();
    }
?>