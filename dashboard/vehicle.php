<?php session_start();
    if(!isset($_SESSION["id"])){
        header('Location:../signin.php');
        exit();
    }
    require_once("../inc/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if(!isset($_GET["vid"])){
            echo "New Vehicle";
        }else{
            echo "Vehicle";
            $data=mysqli_query($connection,"SELECT * FROM vehicle WHERE v_id='".$_GET["vid"]."'");
            $db=mysqli_fetch_assoc($data);
        }
        ?>
    </title>

    <link rel="stylesheet" href="../styles/login.css" />
    <link rel="stylesheet" href="../styles/footer.css" />
    <link rel="stylesheet" href="../styles/index.css" />

    <link rel="stylesheet" href="../css/dashboard.css" type="text/css">
    <link rel="stylesheet" href="../css/vehicle.css" type="text/css">

    <?php include_once('../header.php');?>

    <div class="container dash-main">
        <div class="dash-side">
            <a href="../dashboard.php"><div class="dash-links">Dashboard</div></a>
            <a href="routeplan.php"><div class="dash-links">New Route</div></a>
            <div class="dash-links-select">Add Vehicle</div>
        </div>
        <div class="dash-body">
        <div class="vdetail">
        <h1>Vehicle Details</h1>
        <form name="Vehicles" id="vehicle_detail">
            <input type="text" class="normal" id="num" name="number" placeholder="Vehicle Number ex- LM-1256"<?php if(isset($_GET["vid"])){echo "value='".$db['reg_num']."'";}?> ><br>
            <input type="text" class="normal" id="seat" name="seats" placeholder="Number of seats" <?php if(isset($_GET["vid"])){echo "value='".$db['seats']."'";}?>><br>
            <input type="text" class="normal" id="model" name="model"placeholder="Vehicle Model" <?php if(isset($_GET["vid"])){echo "value='".$db['model']."'";}?>><br>
            <input type="radio" name="air" id="ac" value="1" <?php if(isset($_GET["vid"])){if($db['air']==1)echo "checked";}?>><label for="ac" >AC </label>
            <input type="radio" name="air" id="nonac" value="0" <?php if(isset($_GET["vid"])){if($db['air']==0)echo "checked";}else echo "checked";?>><label for="nonac" >Non-AC</label><br>
            <input type="text" class="normal" id="name" name="name" placeholder="Driver Name" <?php if(isset($_GET["vid"])){echo "value='".$db['name']."'";}?>><br>
            <input type="text" class="normal" id="nic" name="nic"placeholder="Driver Nic" <?php if(isset($_GET["vid"])){echo "value='".$db['nic']."'";}?>><br>
            <input type="text" class="normal" id="contact" name="contact"placeholder="contact number" <?php if(isset($_GET["vid"])){echo "value='".$db['contact']."'";}?>><br>
            <input type="button" class="save butt-add" id="save" value="Save">
        </form>
    </div>
        </div>
    </div>

    
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="../js/vehicle.js"></script>

    <?php include_once('../footer.php');