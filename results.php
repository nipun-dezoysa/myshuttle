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
    require_once("inc/calculations_inc.php");
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
    <title>Result</title>

    <link rel="stylesheet" href="./styles/login.css" />
    <link rel="stylesheet" href="./styles/footer.css" />
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="./css/resultbox.css" />
    <link rel="stylesheet" href="css/dashboard.css" />
    <link rel="stylesheet" href="css/autocomplete.css" />
    
    <?php include_once("header.php")?>

    <!-- Header Section -->
    <?php include_once("searchsection.php");?>

    <!-- Main Content Sections -->
    <section class="container my-5">
        <?php 
            $sql = "SELECT time_table.h_id,time_table.t_id,stops.r_id,route.types,city.name,time_table.tim,COUNT(time_table.t_id) AS count\n"
            . "FROM time_table\n"
            . "INNER JOIN stops ON time_table.s_id = stops.s_id\n"
            . "INNER JOIN city ON city.c_id = stops.c_id\n"
            . "INNER JOIN route ON stops.r_id = route.r_id\n"
            . "WHERE city.name = ? OR city.name = ?\n"
            . "GROUP BY time_table.t_id\n"
            . "ORDER BY time_table.tim ASC;";

            $stmt1 = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt1,$sql)){
                header('Location:index.php');
                exit();
            }
            mysqli_stmt_bind_param($stmt1,"ss",$_GET['start'],$_GET['end']);
            mysqli_stmt_execute($stmt1);
            $turnsRes = mysqli_stmt_get_result($stmt1);
            mysqli_stmt_close($stmt1);

            $countRoute =0;
            
            foreach($turnsRes as $turn){

                if($turn["count"]!=2){
                    continue;
                }

                $query2 = "SELECT vassign.a_id,vassign.r_id,vehicle.reg_num,vehicle.air,vehicle.contact,vehicle.seats FROM vassign INNER JOIN vehicle on vehicle.v_id = vassign.v_id WHERE vassign.r_id =?;";
                $stmt2 = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt2,$query2)){
                    header('Location:index.php');
                    exit();
                }
                mysqli_stmt_bind_param($stmt2,"s",$turn['r_id']);
                mysqli_stmt_execute($stmt2);
                $vehiclesDetails = mysqli_stmt_get_result($stmt2);
                mysqli_stmt_close($stmt2);

                $vehicleCount = mysqli_num_rows($vehiclesDetails);
                $vehiDetail = mysqli_fetch_assoc($vehiclesDetails);

                $routeTypeValid = true;
                if($_GET['type']>0 && $_GET['type']!=$turn['types']){
                    $routeTypeValid=false;
                }

                $query3 = "SELECT time_table.tim, city.name FROM time_table INNER JOIN stops ON time_table.s_id=stops.s_id INNER JOIN city ON city.c_id=stops.c_id WHERE time_table.t_id=? AND city.name=?;";
                $stmt3 = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt3,$query3)){
                    header('Location:index.php');
                    exit();
                }
                mysqli_stmt_bind_param($stmt3,"ss",$turn['t_id'],$_GET['start']);
                mysqli_stmt_execute($stmt3);
                $mss = mysqli_stmt_get_result($stmt3);
                $midStart = mysqli_fetch_assoc($mss);

                mysqli_stmt_bind_param($stmt3,"ss",$turn['t_id'],$_GET['end']);
                mysqli_stmt_execute($stmt3);
                $mee = mysqli_stmt_get_result($stmt3);
                $midEnd = mysqli_fetch_assoc($mee);
                mysqli_stmt_close($stmt3);
                // $turn['name']==$_GET['start']
                if(($midStart['tim']<$midEnd['tim'])&&($vehicleCount>0) && $routeTypeValid){
                    $countRoute++;
                    echo "<div class='result'><div class='s-type ";

                    if($turn['types']==1)echo "shuttle'>Shuttle";
                    elseif($turn['types']==2)echo "service'>Service";
                    else echo "ctb'>Ctb bus";
                    echo " #".$turn['r_id']."/".$turn['t_id'];
                    echo "</div><div class='s-info'><div class='s-name'>";

                    $query4 = "SELECT stops.s_id,stops.r_id,city.name from stops INNER JOIN city on city.c_id=stops.c_id WHERE stops.r_id = ? ORDER by stops.s_id ASC;";
                    $stmt4 = mysqli_stmt_init($connection);
                    if(!mysqli_stmt_prepare($stmt4,$query4)){
                        header('Location:index.php');
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt4,"s",$turn['r_id']);
                    mysqli_stmt_execute($stmt4);
                    $st = mysqli_stmt_get_result($stmt4);
                    mysqli_stmt_close($stmt4);
                    $routeStart = mysqli_fetch_assoc($st);

                    $query5 = "SELECT stops.s_id,stops.r_id,city.name from stops INNER JOIN city on city.c_id=stops.c_id WHERE stops.r_id = ? ORDER by stops.s_id DESC;";
                    $stmt5 = mysqli_stmt_init($connection);
                    if(!mysqli_stmt_prepare($stmt5,$query5)){
                        header('Location:index.php');
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt5,"s",$turn['r_id']);
                    mysqli_stmt_execute($stmt5);
                    $ed = mysqli_stmt_get_result($stmt5);
                    mysqli_stmt_close($stmt5);
                    $routeEnd = mysqli_fetch_assoc($ed);

                    echo strtoupper($routeStart['name'])." - ".strtoupper($routeEnd['name'])."</div>";
                    
                    echo "<div class='vehicle-details'><div class='s-reg'>".$vehiDetail['reg_num']."</div><div class='s-air'>";
                    if($vehiDetail['air']==1)echo "(AC)</div>";
                    else echo "(non-AC)</div>";
                    echo "<div class='s-contact'><a href='tel:".$vehiDetail['contact']."'><input type='button' class='butt-add' value='Contact'></a></div></div></div><div class='s-route'>";


                    $query6 = "SELECT time_table.tim, city.name FROM time_table INNER JOIN stops ON time_table.s_id=stops.s_id INNER JOIN city ON city.c_id=stops.c_id WHERE time_table.t_id=? ORDER BY time_table.tim ASC;";
                    $stmt6 = mysqli_stmt_init($connection);
                    if(!mysqli_stmt_prepare($stmt6,$query6)){
                        header('Location:index.php');
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt6,"s",$turn['t_id']);
                    mysqli_stmt_execute($stmt6);
                    $tS = mysqli_stmt_get_result($stmt6);
                    mysqli_stmt_close($stmt6);

                    $query7 = "SELECT time_table.tim, city.name FROM time_table INNER JOIN stops ON time_table.s_id=stops.s_id INNER JOIN city ON city.c_id=stops.c_id WHERE time_table.t_id=? ORDER BY time_table.tim DESC;";
                    $stmt7 = mysqli_stmt_init($connection);
                    if(!mysqli_stmt_prepare($stmt7,$query7)){
                        header('Location:index.php');
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt7,"s",$turn['t_id']);
                    mysqli_stmt_execute($stmt7);
                    $tE = mysqli_stmt_get_result($stmt7);
                    mysqli_stmt_close($stmt7);
                    
                    $turnStart = mysqli_fetch_assoc($tS);
                    $turnEnd = mysqli_fetch_assoc($tE);
                    if($turnStart['name']==strtolower($_GET['start'])){
                        echo "<div class='s-stop'><div class='s-stop-name'><b>".$turnStart['name']."</b></div><div class='s-stop-time'><b>".setTime($turnStart['tim'])."</b></div></div>";
                        echo "<i class='fa-solid fa-arrow-right'></i>";
                    }
                    else{
                        
                        echo "<div class='s-stop'><div class='s-stop-name'>".$turnStart['name']."</div><div class='s-stop-time'>".setTime($turnStart['tim'])."</div></div>";
                        echo "<i class='fa-solid fa-arrow-right'></i>";
                        echo "<div class='s-stop'><div class='s-stop-name'><b>".$midStart['name']."</b></div><div class='s-stop-time'><b>".setTime($midStart['tim'])."</b></div></div>";
                        echo "<i class='fa-solid fa-arrow-right'></i>";
                    }

                    if($turnEnd['name']==strtolower($_GET['end'])){
                        echo "<div class='s-stop'><div class='s-stop-name'><b>".$turnEnd['name']."</b></div><div class='s-stop-time'><b>".setTime($turnEnd['tim'])."</b></div></div>";
                    }
                    else{
                        
                        echo "<div class='s-stop'><div class='s-stop-name'><b>".$midEnd['name']."</b></div><div class='s-stop-time'><b>".setTime($midEnd['tim'])."</b></div></div>";
                        echo "<i class='fa-solid fa-arrow-right'></i>";
                        echo "<div class='s-stop'><div class='s-stop-name'>".$turnEnd['name']."</div><div class='s-stop-time'>".setTime($turnEnd['tim'])."</div></div>";
                    }
                    echo "</div><div class='full-route'><a href='routeview.php?id=".$turn['r_id']."'>View Full Route</a></div></div>";
                }
            }
            if($countRoute==0){
                echo "<div class='not-found'><h1>not found any route</h1><p>check destination names or order</p></div>";
            }

        ?>        
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <!-- Footer -->
    <?php include_once("footer.php")?>