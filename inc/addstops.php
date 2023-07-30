<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])){
        $city = array();
        $city = $_POST['city'];
        $rid = $_POST['rid'];
        $i =0;
        
        $query1 = "SELECT * FROM city WHERE name=?";
        $stmt1 = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt1,$query1)){
            echo json_encode(array("statusCode"=>202));
            exit();
        }

        $query2 = "INSERT INTO city(name) VALUES (?)";
                $stmt2 = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt2,$query2)){
                    echo json_encode(array("statusCode"=>202));
                    exit();
                }

                $query3 = "INSERT INTO stops(r_id,c_id) VALUES (?,?)";
                $stmt3 = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt3,$query3)){
                    echo json_encode(array("statusCode"=>202));
                    exit();
                }

        foreach($city as $m){
            $i++;
            mysqli_stmt_bind_param($stmt1,"s",$m);
            mysqli_stmt_execute($stmt1);
            $res=mysqli_stmt_get_result($stmt1);
            if (mysqli_num_rows($res)<1){
                
                mysqli_stmt_bind_param($stmt2,"s",$m);
                mysqli_stmt_execute($stmt2);
                
            }
            mysqli_stmt_execute($stmt1);
            $newRes=mysqli_stmt_get_result($stmt1);
            $row=mysqli_fetch_assoc($newRes);
            $c_id = $row["c_id"];
           
                mysqli_stmt_bind_param($stmt3,"ss",$rid,$c_id);
                mysqli_stmt_execute($stmt3);
                
        }
        mysqli_stmt_close($stmt3);
        mysqli_stmt_close($stmt2);
        mysqli_stmt_close($stmt1);
        echo json_encode(array("statusCode"=>201));
		mysqli_close($connection);
    }else{
        header('Location:../index.php');
        exit();
    }
?>