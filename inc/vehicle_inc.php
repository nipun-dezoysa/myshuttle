<?php
    require_once("connection.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])){
        $number = mysqli_real_escape_string($connection,$_POST['number']);
        $seats = mysqli_real_escape_string($connection,$_POST['seats']);
        $model = mysqli_real_escape_string($connection,$_POST['model']);
        $air = mysqli_real_escape_string($connection,$_POST['air']);
        $name = mysqli_real_escape_string($connection,$_POST['name']);
        $nic = mysqli_real_escape_string($connection,$_POST['nic']);
        $contact = mysqli_real_escape_string($connection,$_POST['contact']);

        $query1 = "SELECT * FROM vehicle WHERE reg_num=? AND u_id!=?";
        $stmt1 = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt1,$query1)){
            echo json_encode(array("statusCode"=>202));
            exit();
        }
        mysqli_stmt_bind_param($stmt1,"ss",$number,$_SESSION["id"]);
        mysqli_stmt_execute($stmt1);
        $res = mysqli_stmt_get_result($stmt1);
        mysqli_stmt_close($stmt1);

        if (mysqli_num_rows($res)>0){
			echo json_encode(array("statusCode"=>201));
		}
		else{
            //user ma add karapu thawa vehicle ekak thiyenawada check kirima
            $query2 = "SELECT * FROM vehicle WHERE reg_num=? AND u_id=?";
            $stmt2 = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt2,$query2)){
                echo json_encode(array("statusCode"=>202));
                exit();
            }
            mysqli_stmt_bind_param($stmt2,"ss",$number,$_SESSION["id"]);
            mysqli_stmt_execute($stmt2);
            $exist = mysqli_stmt_get_result($stmt2);
            mysqli_stmt_close($stmt2);

            if (mysqli_num_rows($exist)>0){
                $update=mysqli_fetch_assoc($exist);
                $query3 = "UPDATE vehicle SET name=?, nic=?, seats=?, model=?, air=?, contact=? WHERE v_id=?;";
                $stmt3 = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt3,$query3)){
                    echo json_encode(array("statusCode"=>202));
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt3,"ssisiss",$name,$nic,$seats,$model,$air,$contact,$update['v_id']);
                    mysqli_stmt_execute($stmt3);
                    $exist = mysqli_stmt_get_result($stmt3);
                    echo json_encode(array("statusCode"=>200));
                }
                mysqli_stmt_close($stmt3);
            }
			else{

                $query4 = "INSERT INTO vehicle(u_id,name,nic,reg_num,seats,model,air,contact) VALUES (?,?,?,?,?,?,?,?);";
                $stmt4 = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt4,$query4)){
                    echo json_encode(array("statusCode"=>202));
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt4,"ssssisis",$_SESSION["id"],$name,$nic,$number,$seats,$model,$air,$contact);
                    mysqli_stmt_execute($stmt4);
                    $exist = mysqli_stmt_get_result($stmt4);
                    echo json_encode(array("statusCode"=>200));
                }
                mysqli_stmt_close($stmt4);
            }
		}
		mysqli_close($connection);
    
    }else{
        header('Location:../signin.php');
        exit();
    }
?>