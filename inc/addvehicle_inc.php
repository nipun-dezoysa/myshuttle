<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])){
        $vid = $_POST['vid'];
        $rid = $_POST['rid'];

        $query1 = "SELECT * FROM vassign WHERE r_id=? AND v_id=?;";
        $stmt1 = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt1,$query1)){
            echo json_encode(array("statusCode"=>202));
            exit();
        }
        mysqli_stmt_bind_param($stmt1,"ss",$rid,$vid);
        mysqli_stmt_execute($stmt1);
        $res=mysqli_stmt_get_result($stmt1);
        mysqli_stmt_close($stmt1);

        if(mysqli_num_rows($res)<1){

            $query2 = "INSERT INTO vassign(r_id,v_id) VALUES (?,?)";
            $stmt2 = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt2,$query2)){
                echo json_encode(array("statusCode"=>202));
                exit();
            }
            mysqli_stmt_bind_param($stmt2,"ss",$rid,$vid);
            mysqli_stmt_execute($stmt2);
            $res=mysqli_stmt_get_result($stmt2);
            mysqli_stmt_close($stmt2);
            echo json_encode(array("statusCode"=>201));
        }
        else{
            echo json_encode(array("statusCode"=>202));
        }
		mysqli_close($connection);
    }else{
        header('Location:../dashboard.php');
        exit();
    }
?>