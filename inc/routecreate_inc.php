<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $type = $_POST['type'];
        
        if(mysqli_query($connection,"INSERT INTO route(u_id,types) VALUES ('".$_SESSION["id"]."','".$type."')")){
            $result =mysqli_query($connection,"SELECT * FROM route WHERE u_id='".$_SESSION["id"]."' ORDER BY r_id DESC");
            $row=mysqli_fetch_assoc($result);
            $r_id = $row["r_id"];
            echo json_encode(array("statusCode"=>200,"rid"=>$r_id));
        }
		mysqli_close($connection);
    }else{
        header('Location:../index.php');
        exit();
    }
?>