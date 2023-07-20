<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $times = array();
        $times = $_POST['times'];
        $rid = $_POST['rid'];
        $type = $_POST['type'];

        mysqli_query($connection,"INSERT INTO turn(r_id,type) VALUES ('".$rid."','".$type."')");
        $res=mysqli_query($connection,"SELECT * FROM turn WHERE r_id='".$rid."' ORDER BY t_id DESC");
        $turn=mysqli_fetch_assoc($res);

        if($type==1){
            $cities=mysqli_query($connection,"SELECT * FROM stops WHERE r_id='".$rid."' ORDER BY s_id ASC");
            for($i=0;$i<mysqli_num_rows($cities);$i++){
                $city=mysqli_fetch_assoc($cities);
                mysqli_query($connection,"INSERT INTO time_table(t_id,s_id,tim) VALUES ('".$turn['t_id']."','".$city['s_id']."','".$times[$i]."')");
            }
        }else{
            $cities=mysqli_query($connection,"SELECT * FROM stops WHERE r_id='".$rid."' ORDER BY s_id DESC");
            for($i=mysqli_num_rows($cities)-1;$i>=0;$i--){
                $city=mysqli_fetch_assoc($cities);
                mysqli_query($connection,"INSERT INTO time_table(t_id,s_id,tim) VALUES ('".$turn['t_id']."','".$city['s_id']."','".$times[$i]."')");
            }
        }
        

        echo json_encode(array("statusCode"=>201));
		mysqli_close($connection);
    }else{
        header('Location:../index.php');
        exit();
    }
?>