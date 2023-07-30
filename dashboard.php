<?php session_start();
    if(!isset($_SESSION["id"])){
        header('Location:signin.php');
        exit();
    }
    require_once("inc/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css" type="text/css">
    <script src="https://kit.fontawesome.com/296e3cb483.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./styles/login.css" />
    <link rel="stylesheet" href="./styles/footer.css" />
    <link rel="stylesheet" href="./styles/index.css" />


    <?php include_once("header.php");?>

    <div class="container dash-main">
        <div class="dash-side">
            <div class="dash-links-select">Dashboard</div>
            <a href="dashboard/routeplan.php"><div class="dash-links">New Route</div></a>
            <a href="dashboard/vehicle.php"><div class="dash-links">Add Vehicle</div></a>
        </div>
        <div class="dash-body">
            <div class="dash-section">
                <div class="dash-section-head">
                    <div class="dash-section-head-name">Routes</div>
                    <input type="button" id="create"  class="butt-add" value="create a new route">
                </div>
                <div class="dash-section-body">
                    <?php
                        $res=mysqli_query($connection,"SELECT * FROM route WHERE u_id='".$_SESSION["id"]."' ORDER BY r_id DESC");
                        foreach($res as $row){
                            $start=mysqli_query($connection,"SELECT * FROM stops WHERE r_id='".$row["r_id"]."' ORDER BY s_id ASC");
                            $h = mysqli_fetch_assoc($start);
                            $end=mysqli_query($connection,"SELECT * FROM stops WHERE r_id='".$row["r_id"]."' ORDER BY s_id DESC");
                            $g = mysqli_fetch_assoc($end);
                            $stname = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM city WHERE c_id='".$h["c_id"]."'"));
                            $endname = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM city WHERE c_id='".$g["c_id"]."'"));
                            echo "<div class='dash-section-body-item'>";
                            echo "<div class='item-name'>".$stname["name"]." - ".$endname["name"]."</div>";
                            echo "<div><a href='dashboard/route.php?id=".$row['r_id']."'><input type='button' class='butt-edit' value='edit'></a><input type='button' class='butt-delete' onClick='deleteItem(".$row["r_id"].",1)' value='delete'></div></div>";

                        }
                    
                    ?>
                </div>
            </div>

            <div class="dash-section">
                <div class="dash-section-head">
                    <div class="dash-section-head-name">Vehicles</div>
                    <input type="button" class="butt-add" id="add" value="add Vehicle">
                </div>
                <div class="dash-section-body">
                    <?php
                        $res=mysqli_query($connection,"SELECT * FROM vehicle WHERE u_id='".$_SESSION["id"]."' ORDER BY v_id DESC");
                        foreach($res as $row){
                            echo "<div class='dash-section-body-item'>";
                            echo "<div class='item-name'>".$row["reg_num"]."</div>";
                            echo "<div><a href='dashboard/vehicle.php?vid=".$row['v_id']."'><input type='button' class='butt-edit' value='edit'></a><input type='button' class='butt-delete' onClick='deleteItem(".$row["v_id"].",2)'  value='delete'></div></div>";

                        }

                    ?>
                </div>
            </div>

        </div>
    </div>

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="js/dashboard.js"></script>

    <?php include_once("footer.php");?>