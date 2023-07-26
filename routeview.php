<?php 
    session_start();
    // if(!isset($_SESSION["id"])){
    //     header('Location:signin.php');
    //     exit();
    // }
	require_once("inc/connection.php");
    require_once("inc/calculations_inc.php");
    // $result=mysqli_query($connection,"SELECT * FROM city ORDER BY name ASC");
    // $data = array();
    // foreach($result as $row)
    // {
    //     $data[] = array(
    //         'label'     =>  $row["name"],
    //         'value'     =>  $row["name"]
    //     );
    // }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bootstrap Dummy Data</title>

    <script src="dashboard/library/autocomplete.js"></script>

    <link rel="stylesheet" href="./styles/login.css" />
    <link rel="stylesheet" href="./styles/footer.css" />
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="css/routeview.css" />
    <link rel="stylesheet" href="css/dashboard.css" />
        
    <?php include_once("header.php") ?>
    <?php
    $hh = mysqli_query($connection,"SELECT vassign.r_id,vassign.v_id,vehicle.name,vehicle.nic,vehicle.reg_num,vehicle.seats,vehicle.model,vehicle.air,vehicle.contact,user.f_name FROM vassign INNER JOIN vehicle ON vassign.v_id=vehicle.v_id INNER JOIN user ON user.u_id=vehicle.u_id WHERE vassign.r_id=".$_GET['id'].";");
    $vehicle = mysqli_fetch_assoc($hh);
    $startName = mysqli_fetch_assoc(mysqli_query($connection,"SELECT stops.s_id,stops.r_id,city.name from stops INNER JOIN city on city.c_id=stops.c_id WHERE stops.r_id = ".$_GET['id']." ORDER by stops.s_id ASC;"));
    $endName = mysqli_fetch_assoc(mysqli_query($connection,"SELECT stops.s_id,stops.r_id,city.name from stops INNER JOIN city on city.c_id=stops.c_id WHERE stops.r_id = ".$_GET['id']." ORDER by stops.s_id DESC;"));
    
    ?>
    <div class="mainroute container">
        <h1 class="route-name"><?php echo strtoupper($startName['name'])." - ".strtoupper($endName['name'])." ";?><span>#<?php echo $_GET['id'] ?></span></h1>
        <p>added by <?php echo $vehicle['f_name'];?></p>
        <div class="route-bus">
            <div class="route-bus-pic">
                <img src="img/bus.jpg" alt="yellow bus">
            </div>
            <div class="route-bus-details">
                <div class="bus-detail"><span>Reg-No: </span><?php echo $vehicle['reg_num'];?></div>
                <div class="bus-detail"><span>Seats: </span><?php echo $vehicle['seats'];?></div>
                <div class="bus-detail"><span>Model: </span><?php echo $vehicle['model'];?></div>
                <div class="bus-detail"><?php if($vehicle['air']==1)echo "AC"; else echo "non-AC"; ?></div>
                <div class="bus-detail"><?php echo $vehicle['name'];?></div>
                <div class="bus-detail"><?php echo $vehicle['contact']; ?><a href="tel:<?php echo $vehicle['contact'] ?>"><input type="button" class="butt-add" value="Contact"></a></div>
            </div>
        </div>
        <div class="turn-section-name">Turn</div>
                    <?php
                    $c = 0;
                    $turns=mysqli_query($connection,"SELECT turn.t_id,time_table.tim FROM turn INNER JOIN time_table ON turn.t_id=time_table.t_id WHERE turn.r_id=".$_GET['id']." GROUP BY time_table.t_id ORDER BY time_table.tim ASC;");
                    
                    foreach($turns as $tt){
                        $c++;
                        echo "<div class='turns-body'>";
                        echo "<div class='turns-head'>Turn ".$c."</div>";
                        echo "<div class='turns-turn'>";
                        $times=mysqli_query($connection,"SELECT * FROM time_table WHERE t_id='".$tt["t_id"]."'");
                        $nfturns = mysqli_num_rows($times);
                        $scount = 1;
                        foreach ($times as $clock) {
                            $stop=mysqli_query($connection,"SELECT * FROM stops WHERE s_id='".$clock["s_id"]."'");
                            $f=mysqli_fetch_assoc($stop);
                            $name=mysqli_query($connection,"SELECT * FROM city WHERE c_id='".$f["c_id"]."'");
                            $g=mysqli_fetch_assoc($name);
                            
                            echo "<div class='turns-stop'><div class='turn-stop-name'>".$g['name']."</div><div class='turn-stop-time'>".setTime($clock['tim'])."</div></div>";
                            if($scount!=$nfturns) echo "<i class='fa-solid fa-arrow-right'></i>";
                            $scount++;
                        }
                        echo "</div></div>";
                    }
                    ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <?php include_once("footer.php") ?>
