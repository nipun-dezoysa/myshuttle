<?php 
    session_start();
    // if(!isset($_SESSION["id"])){
    //     header('Location:signin.php');
    //     exit();
    // }
    if(!isset($_GET["start"]) || !isset($_GET["end"]) || !isset($_GET["type"])){
        header('Location:index.php');
        exit();
    }
	require_once("inc/connection.php");
    $result=mysqli_query($connection,"SELECT * FROM city ORDER BY name ASC");
    $data = array();
    foreach($result as $row)
    {
        $data[] = array(
            'label'     =>  $row["name"],
            'value'     =>  $row["name"]
        );
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transport</title>

    <link rel="stylesheet" href="./styles/login.css" />
    <link rel="stylesheet" href="./styles/footer.css" />
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="./css/resultbox.css" />
    
    <?php include_once("header.php")?>

    <!-- Header Section -->
    <?php include_once("searchsection.php");?>

    <!-- Main Content Sections -->
    <section class="container my-5">
        <?php 
            function setTime($a){
                $hour = intdiv($a, 100);
                $minute = $a%100;
                $minuteStr= "";
                if($minute<10){
                    $minuteStr = "0".$minute;
                }
                if($hour<=12){
                    return $hour.":".$minuteStr."AM";
                }
                else{
                    $hour-=12;
                    return $hour.":".$minuteStr."PM";
                }
            }
            $sql = "SELECT time_table.h_id,time_table.t_id,stops.r_id,route.types,city.name,time_table.tim,COUNT(time_table.t_id) AS count\n"
            . "FROM time_table\n"
            . "INNER JOIN stops ON time_table.s_id = stops.s_id\n"
            . "INNER JOIN city ON city.c_id = stops.c_id\n"
            . "INNER JOIN route ON stops.r_id = route.r_id\n"
            . "WHERE city.name = '".$_GET['start']."' OR city.name = '".$_GET['end']."'\n"
            . "GROUP BY time_table.t_id\n"
            . "ORDER BY time_table.tim ASC;";

            $turnsRes = mysqli_query($connection,$sql);
            foreach($turnsRes as $turn){
                if($turn['name']==$_GET['start'] && $turn['count']==2){
                    echo "<div class='result'><div class='s-type'>";
                    if($turn['types']==1)echo "Shuttle";
                    elseif($turn['types']==2)echo "Service";
                    else echo "Ctb bus";
                    echo "</div><div class='s-info'><div class='s-name'>";
                    $st = mysqli_query($connection,"SELECT stops.s_id,stops.r_id,city.name from stops INNER JOIN city on city.c_id=stops.c_id WHERE stops.r_id = ".$turn['r_id']." ORDER by stops.s_id ASC;");
                    $routeStart = mysqli_fetch_assoc($st);
                    $ed = mysqli_query($connection,"SELECT stops.s_id,stops.r_id,city.name from stops INNER JOIN city on city.c_id=stops.c_id WHERE stops.r_id = ".$turn['r_id']." ORDER by stops.s_id DESC;");
                    $routeEnd = mysqli_fetch_assoc($ed);
                    echo $routeStart['name']." - ".$routeEnd['name']."</div>";
                    $vehiclesDetails = mysqli_query($connection,"SELECT vassign.a_id,vassign.r_id,vehicle.reg_num,vehicle.air,vehicle.contact,vehicle.seats FROM vassign INNER JOIN vehicle on vehicle.v_id = vassign.v_id WHERE vassign.r_id = ".$turn['r_id'].";");
                    $vehiDetail = mysqli_fetch_assoc($vehiclesDetails);
                    echo "<div class='s-reg'>".$vehiDetail['reg_num']."</div><div class='s-air'>";
                    if($vehiDetail['air']==1)echo "AC</div>";
                    else echo "Non-Ac</div>";
                    echo "<div class='s-contact'>".$vehiDetail['contact']."</div></div><div class='s-route'>";
                    if($routeStart['name']==$_GET['start']){
                        echo "<div class='s-stop'><div class='s-stop-name'><b>".$routeStart['name']."</b></div><div class='s-stop-time'><b>".setTime($turn['tim'])."</b></div></div>";
                        echo "<i class='fa-solid fa-arrow-right'></i>";
                    }
                    else{
                        echo "<div class='s-stop'><div class='s-stop-name'>".$routeStart['name']."</div><div class='s-stop-time'>".setTime($turn['tim'])."</div></div>";
                        echo "<i class='fa-solid fa-arrow-right'></i>";
                        echo "<div class='s-stop'><div class='s-stop-name'><b>".$_GET['start']."</b></div><div class='s-stop-time'><b>".setTime($turn['tim'])."</b></div></div>";
                        echo "<i class='fa-solid fa-arrow-right'></i>";
                    }

                    if($routeEnd['name']==$_GET['end']){
                        echo "<div class='s-stop'><div class='s-stop-name'><b>".$routeEnd['name']."</b></div><div class='s-stop-time'><b>".setTime($turn['tim'])."</b></div></div>";
                    }
                    else{
                        echo "<div class='s-stop'><div class='s-stop-name'><b>".$_GET['end']."</b></div><div class='s-stop-time'><b>".setTime($turn['tim'])."</b></div></div>";
                        echo "<i class='fa-solid fa-arrow-right'></i>";
                        echo "<div class='s-stop'><div class='s-stop-name'>".$routeEnd['name']."</div><div class='s-stop-time'>".setTime($turn['tim'])."</div></div>";
                    }
                    echo "</div><div class='full-route'>View Full Route</div></div>";


                }
            }

        ?>        
    </section>

    <!-- Footer -->
    <?php include_once("footer.php")?>