<?php session_start();
    if(!isset($_SESSION["id"])){
        header('Location:../signin.php');
        exit();
    }
    if(!isset($_GET["id"])){
        header('Location:../dashboard.php');
        exit();
    }

    require_once("../inc/connection.php");

    $query2 = "SELECT * FROM route WHERE r_id=?";
        $stmt2 = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt2,$query2)){
            header('Location:../signup.php');
            exit();
        }
        mysqli_stmt_bind_param($stmt2,"s",$_GET["id"]);
        mysqli_stmt_execute($stmt2);
        $userc = mysqli_stmt_get_result($stmt2);
        mysqli_stmt_close($stmt2);
        if(mysqli_num_rows($userc)<1){
            header('Location:../dashboard.php');
            exit();
        }
        $userconfirm = mysqli_fetch_assoc($userc);
        if($_SESSION["id"]!=$userconfirm["u_id"]){
            header('Location:../dashboard.php');
            exit();
        } 

    require_once("../inc/calculations_inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Route</title>
    <link rel="stylesheet" href="../css/route.css" type="text/css">

    <link rel="stylesheet" href="../styles/login.css" />
    <link rel="stylesheet" href="../styles/footer.css" />
    <link rel="stylesheet" href="../styles/index.css" />

    <link rel="stylesheet" href="../css/dashboard.css" type="text/css">

    <?php include_once("../header.php");?>

    <div class="container dash-main">
        <div class="dash-side">
            <a href="../dashboard.php"><div class="dash-links">Dashboard</div></a>
            <div class="dash-links-select">New Route</div>
            <a href="vehicle.php"><div class="dash-links">Add Vehicle</div></a>
        </div>
        <div class="dash-body">
        <div class="route">
            <div class="route-head">
                Route
            </div>
            <div class="route-body">
                <div class="route-body-add">
                    <h3 >Create new turn</h3>
                    Route Order: <input type="button" id="order" onclick="changeOrder()" value="Normal">
                    
                    <div id="jj" class="route-stops">
                        <?php
                        $data=mysqli_query($connection,"SELECT * FROM stops WHERE r_id='".$_GET["id"]."'");
                        $count =0;
                        foreach($data as $row){
                            $count++;
                            $cities=mysqli_query($connection,"SELECT * FROM city WHERE c_id='".$row["c_id"]."'");
                            $city=mysqli_fetch_assoc($cities);
                            echo "<div class='stop'>";
                            echo "<div class='stop-name'>".$city['name']."</div>";
                            echo "<div class='stop-time'>";
                            echo "<input type='number' maxlength='2' id='h".$count."' placeholder='hh'>:<input type='number' maxlength='2' id='m".$count."' placeholder='mm'> </div></div>";
                        } 
                        ?>
                    </div>
                    <?php echo "<input type='button' class='butt-add' id='add' onclick='addTurn(".$count.",".$_GET["id"].")' value='Add Turn'>"; ?>
                </div>
                <div class="route-body-pre">
                    <?php
                    $c = 0;
                    $turns=mysqli_query($connection,"SELECT turn.t_id,time_table.tim FROM turn INNER JOIN time_table ON turn.t_id=time_table.t_id WHERE turn.r_id=".$_GET['id']." GROUP BY time_table.t_id ORDER BY time_table.tim ASC;");
                    
                    foreach($turns as $tt){
                        $c++;
                        echo "<div class='pre'><div class='pre-head'>";
                        echo "<div class='pre-head-name'>Turn - ".$c."</div>";
                        echo "<div class='pre-head-delete'><input type='button' class='butt-delete' onClick='deleteItem(".$tt["t_id"].",3)' value='delete'></div></div>";
                        echo "<div class='pre-body'>";
                        $times=mysqli_query($connection,"SELECT * FROM time_table WHERE t_id='".$tt["t_id"]."'");
                        $nfturns = mysqli_num_rows($times);
                        $scount = 1;
                        foreach ($times as $clock) {
                            $stop=mysqli_query($connection,"SELECT * FROM stops WHERE s_id='".$clock["s_id"]."'");
                            $f=mysqli_fetch_assoc($stop);
                            $name=mysqli_query($connection,"SELECT * FROM city WHERE c_id='".$f["c_id"]."'");
                            $g=mysqli_fetch_assoc($name);
                            
                            echo "<div class='pre-stop'>".$g['name']."(".setTime($clock['tim']).") ";
                            if($scount!=$nfturns) echo "<i class='fa-solid fa-arrow-right fa-2xs'></i>";
                            echo "</div>";
                            $scount++;
                        }
                        echo "</div></div>";
                    }
                    ?>
                    

                </div>
            </div>
        </div>

        <div class="vehi">
            <div class="route-head">Vehicle</div>
            <div class="vehi-add">
                    <select name="vehicle" id="vehicle">
                        <?php 
                        $vehicles=mysqli_query($connection,"SELECT * FROM vehicle WHERE u_id='".$_SESSION["id"]."'");
                        foreach($vehicles as $bus){
                            echo "<option value='".$bus['v_id']."'>".$bus['reg_num']."</option>";
                        }
                        ?>
                    </select>
                <input type="button" class='butt-add' <?php echo "onclick='addVehicle(".$_GET["id"].")'"; ?> id="vehicleadd" value="add Vehicle">
            </div>
            <div class="vehicle-pre">
                <?php 
                $turnVehicle=mysqli_query($connection,"SELECT * FROM vassign WHERE r_id='".$_GET["id"]."'");
                foreach($turnVehicle as $vehi){
                    $wahanaya=mysqli_query($connection,"SELECT * FROM vehicle WHERE v_id='".$vehi["v_id"]."'");
                    $vehiName=mysqli_fetch_assoc($wahanaya);
                    echo "<div class='vehi-item'><div class='vehicle-name'>".$vehiName['reg_num']."</div><div class='vehicle-delete'><input type='button' class='butt-delete'  onClick='deleteItem(".$vehi["a_id"].",4)' value='delete'></div></div>";
                }
                ?>
            </div>
        </div>
        </div>
    </div>
  
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src= "../js/route.js"></script>

    <?php include_once("../footer.php");?>