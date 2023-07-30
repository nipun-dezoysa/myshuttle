<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])){
        $times = array();
        $times = $_POST['times'];
        $rid = $_POST['rid'];
        $type = $_POST['type'];

        $query8 = "SELECT * FROM route WHERE r_id=?";
        $stmt8 = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt8,$query8)){
            echo json_encode(array("statusCode"=>202));
            exit();
        }
        mysqli_stmt_bind_param($stmt8,"s",$rid);
        mysqli_stmt_execute($stmt8);
        $ex=mysqli_stmt_get_result($stmt8);
        mysqli_stmt_close($stmt8);
        $user=mysqli_fetch_assoc($ex);

        if($_SESSION['id']==$user['u_id']){
            $query1 = "INSERT INTO turn(r_id,type) VALUES (?,?);";
            $stmt1 = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt1,$query1)){
                echo json_encode(array("statusCode"=>202));
                exit();
            }
            mysqli_stmt_bind_param($stmt1,"si",$rid,$type);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_close($stmt1);


            $query2 = "SELECT * FROM turn WHERE r_id=? ORDER BY t_id DESC";
            $stmt2 = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt2,$query2)){
                echo json_encode(array("statusCode"=>202));
                exit();
            }
            mysqli_stmt_bind_param($stmt2,"s",$rid);
            mysqli_stmt_execute($stmt2);
            $res=mysqli_stmt_get_result($stmt2);
            mysqli_stmt_close($stmt2);

            $turn=mysqli_fetch_assoc($res);

            $query4 = "INSERT INTO time_table(t_id,s_id,tim) VALUES (?,?,?)";
            $stmt4 = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt4,$query4)){
                echo json_encode(array("statusCode"=>202));
                exit();
            }
            
            
            if($type==1){

                $query3 = "SELECT * FROM stops WHERE r_id=? ORDER BY s_id ASC";
                $stmt3 = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt3,$query3)){
                    echo json_encode(array("statusCode"=>202));
                    exit();
                }
                mysqli_stmt_bind_param($stmt3,"s",$rid);
                mysqli_stmt_execute($stmt3);
                $cities=mysqli_stmt_get_result($stmt3);
                mysqli_stmt_close($stmt3);

                for($i=0;$i<mysqli_num_rows($cities);$i++){
                    $city=mysqli_fetch_assoc($cities);
                    mysqli_stmt_bind_param($stmt4,"ssi",$turn['t_id'],$city['s_id'],$times[$i]);
                    mysqli_stmt_execute($stmt4);
                }
            }else{
                $query3 = "SELECT * FROM stops WHERE r_id=? ORDER BY s_id DESC";
                $stmt3 = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt3,$query3)){
                    echo json_encode(array("statusCode"=>202));
                    exit();
                }
                mysqli_stmt_bind_param($stmt3,"s",$rid);
                mysqli_stmt_execute($stmt3);
                $cities=mysqli_stmt_get_result($stmt3);
                mysqli_stmt_close($stmt3);
                for($i=mysqli_num_rows($cities)-1;$i>=0;$i--){
                    $city=mysqli_fetch_assoc($cities);
                    mysqli_stmt_bind_param($stmt4,"ssi",$turn['t_id'],$city['s_id'],$times[$i]);
                    mysqli_stmt_execute($stmt4);
                }
            }
            
            mysqli_stmt_close($stmt4);

            echo json_encode(array("statusCode"=>201));
        }

        
		mysqli_close($connection);
    }else{
        header('Location:../index.php');
        exit();
    }
?>