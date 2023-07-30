<?php
    session_start();
    require_once("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])){
        $id = $_POST['id'];
        $type = $_POST['type'];

        if($type==1){

            $query1 = "SELECT u_id FROM route WHERE r_id=?";
            $stmt1 = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt1,$query1)){
                echo json_encode(array("statusCode"=>201));
                exit();
            }
            mysqli_stmt_bind_param($stmt1,"s",$id);
            mysqli_stmt_execute($stmt1);
            $res=mysqli_stmt_get_result($stmt1);
            mysqli_stmt_close($stmt1);
            $ex=mysqli_fetch_assoc($res);

            if($ex['u_id']==$_SESSION['id']){

                $query = "DELETE FROM route WHERE r_id=?;";
                $stmt = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt,$query)){
                    header('Location:../signup.php');
                    exit();
                }
                mysqli_stmt_bind_param($stmt,"s",$id);
                if(mysqli_stmt_execute($stmt)){
                    echo json_encode(array("statusCode"=>200));
                }else{
                    echo json_encode(array("statusCode"=>201));
                }
                mysqli_stmt_close($stmt);
            }
        }
        elseif($type==2){


            $query1 = "SELECT u_id FROM vehicle WHERE v_id=?";
            $stmt1 = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt1,$query1)){
                echo json_encode(array("statusCode"=>201));
                exit();
            }
            mysqli_stmt_bind_param($stmt1,"s",$id);
            mysqli_stmt_execute($stmt1);
            $res=mysqli_stmt_get_result($stmt1);
            mysqli_stmt_close($stmt1);
            $ex=mysqli_fetch_assoc($res);

            if($ex['u_id']==$_SESSION['id']){

                $query = "DELETE FROM vehicle WHERE v_id=?;";
                $stmt = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt,$query)){
                    header('Location:../signup.php');
                    exit();
                }
                mysqli_stmt_bind_param($stmt,"s",$id);
                if(mysqli_stmt_execute($stmt)){
                    echo json_encode(array("statusCode"=>200));
                }else{
                    echo json_encode(array("statusCode"=>201));
                }
                mysqli_stmt_close($stmt);
            }
        }
        elseif($type==3){
            $query1 = "SELECT route.u_id FROM turn INNER JOIN route ON route.r_id=turn.r_id WHERE turn.t_id=?;";
            $stmt1 = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt1,$query1)){
                echo json_encode(array("statusCode"=>201));
                exit();
            }
            mysqli_stmt_bind_param($stmt1,"s",$id);
            mysqli_stmt_execute($stmt1);
            $res=mysqli_stmt_get_result($stmt1);
            mysqli_stmt_close($stmt1);
            $ex=mysqli_fetch_assoc($res);

            if($ex['u_id']==$_SESSION['id']){
            
                $query = "DELETE FROM turn WHERE t_id=?;";
                $stmt = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt,$query)){
                    header('Location:../signup.php');
                    exit();
                }
                mysqli_stmt_bind_param($stmt,"s",$id);
                if(mysqli_stmt_execute($stmt)){
                    echo json_encode(array("statusCode"=>200));
                }else{
                    echo json_encode(array("statusCode"=>201));
                }
                mysqli_stmt_close($stmt);
            }
        }
        elseif($type==4){
            $query1 = "SELECT vehicle.u_id FROM vassign INNER JOIN vehicle ON vehicle.v_id=vassign.v_id WHERE vassign.a_id=?;";
            $stmt1 = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt1,$query1)){
                echo json_encode(array("statusCode"=>201));
                exit();
            }
            mysqli_stmt_bind_param($stmt1,"s",$id);
            mysqli_stmt_execute($stmt1);
            $res=mysqli_stmt_get_result($stmt1);
            mysqli_stmt_close($stmt1);
            $ex=mysqli_fetch_assoc($res);

            if($ex['u_id']==$_SESSION['id']){
                $query = "DELETE FROM vassign WHERE a_id=?;";
                $stmt = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt,$query)){
                    header('Location:../signup.php');
                    exit();
                }
                mysqli_stmt_bind_param($stmt,"s",$id);
                if(mysqli_stmt_execute($stmt)){
                    echo json_encode(array("statusCode"=>200));
                }else{
                    echo json_encode(array("statusCode"=>201));
                }
                mysqli_stmt_close($stmt);
            }
        }
		mysqli_close($connection);
    }else{
        header('Location:../index.php');
        exit();
    }
?>