<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])){
        $type = $_POST['type'];

        $query1 = "INSERT INTO route(u_id,types) VALUES (?,?)";
        $stmt1 = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt1,$query1)){
            header('Location:../signup.php');
            exit();
        }
        mysqli_stmt_bind_param($stmt1,"si",$_SESSION["id"],$type);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_close($stmt1);

        $query2 = "SELECT * FROM route WHERE u_id=? ORDER BY r_id DESC";
        $stmt2 = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt2,$query2)){
            header('Location:../signup.php');
            exit();
        }
        mysqli_stmt_bind_param($stmt2,"s",$_SESSION["id"]);
        mysqli_stmt_execute($stmt2);
        $result = mysqli_stmt_get_result($stmt2);
        mysqli_stmt_close($stmt2);
        
        $row=mysqli_fetch_assoc($result);
        $r_id = $row["r_id"];
        echo json_encode(array("statusCode"=>200,"rid"=>$r_id));    
		mysqli_close($connection);
    }else{
        header('Location:../index.php');
        exit();
    }
?>