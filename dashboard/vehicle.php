<?php session_start();
    if(!isset($_SESSION["id"])){
        header('Location:signin.php');
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
        }
        ?>
    </title>
</head>
<body>
    <div class="vdetail">
        <form name="Vehicles" id="vehicle_detail">
            <input type="text" name="number" placeholder="Vehicle Number ex- LM-1256"><br>
            <input type="text" name="seats" placeholder="Number of seats"><br>
            <input type="text" name="model"placeholder="Vehicle Model"><br>
            <input type="radio" name="air" id="ac" value="1"><label for="ac">ac</label>
            <input type="radio" name="air" id="nonac" value="0"><br>
            <input type="text" name="name" placeholder="Driver Name"><br>
            <input type="text" name="nic"placeholder="Driver Nic"><br>
            <input type="text" name="contact"placeholder="contact number"><br>
            <input type="button" id="save" value="Save">
        </form>
    </div>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="../js/vehicle.js"></script>
</body>
</html>