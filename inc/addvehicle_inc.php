<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $vid = $_POST['vid'];
        $rid = $_POST['rid'];
        $res=mysqli_query($connection,"SELECT * FROM vassign WHERE r_id='".$rid."' AND v_id='".$vid."'");

        if(mysqli_num_rows($res)<1){
            mysqli_query($connection,"INSERT INTO vassign(r_id,v_id) VALUES ('".$rid."','".$vid."')");
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