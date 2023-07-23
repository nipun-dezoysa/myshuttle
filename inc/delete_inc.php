<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST['id'];
        $type = $_POST['type'];

        if($type==1){
            if(mysqli_query($connection,"DELETE FROM route WHERE r_id=".$id)){
                echo json_encode(array("statusCode"=>200));
            }else{
                echo json_encode(array("statusCode"=>201));
            }
        }
        elseif($type==2){
            if(mysqli_query($connection,"DELETE FROM vehicle WHERE v_id=".$id)){
                echo json_encode(array("statusCode"=>200));
            }else{
                echo json_encode(array("statusCode"=>201));
            }
        }
        elseif($type==3){
            if(mysqli_query($connection,"DELETE FROM turn WHERE t_id=".$id)){
                echo json_encode(array("statusCode"=>200));
            }else{
                echo json_encode(array("statusCode"=>201));
            }
        }
        elseif($type==4){
            if(mysqli_query($connection,"DELETE FROM vassign WHERE a_id=".$id)){
                echo json_encode(array("statusCode"=>200));
            }else{
                echo json_encode(array("statusCode"=>201));
            }
        }

        

		mysqli_close($connection);
    }else{
        header('Location:../index.php');
        exit();
    }
?>