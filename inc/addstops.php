<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $city = array();
        $city = $_POST['city'];
        $rid = $_POST['rid'];

        // $res=mysqli_query($connection,"SELECT * FROM city WHERE name='".$city."'");
        // if (mysqli_num_rows($res)<1){
		// 	mysqli_query($connection,"INSERT INTO city(name) VALUES ('".$city."')");
		// }
        // $newRes=mysqli_query($connection,"SELECT * FROM city WHERE name='".$city."'");
        // $row=mysqli_fetch_assoc($newRes);
        // $c_id = $row["c_id"];

        foreach($city as $m){
            $res=mysqli_query($connection,"SELECT * FROM city WHERE name='".$m."'");
            if (mysqli_num_rows($res)<1){
                mysqli_query($connection,"INSERT INTO city(name) VALUES ('".$m."')");
            }
            $newRes=mysqli_query($connection,"SELECT * FROM city WHERE name='".$m."'");
            $row=mysqli_fetch_assoc($newRes);
            $c_id = $row["c_id"];
            mysqli_query($connection,"INSERT INTO stops(r_id,c_id) VALUES ('".$rid."','".$c_id."')");
        }

        echo json_encode(array("statusCode"=>201));
		mysqli_close($connection);
    }else{
        header('Location:../index.php');
        exit();
    }
?>