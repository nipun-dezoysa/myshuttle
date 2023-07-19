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
            $data=mysqli_query($connection,"SELECT * FROM vehicle WHERE v_id='".$_GET["vid"]."'");
            $db=mysqli_fetch_assoc($data);
        }
        ?>
    </title>
</head>
<body>
    <div class="vdetail">
        <form name="Vehicles" id="vehicle_detail">
            <input type="text" name="number" placeholder="Vehicle Number ex- LM-1256"<?php if(isset($_GET["vid"])){echo "value='".$db['reg_num']."'";}?> ><br>
            <input type="text" name="seats" placeholder="Number of seats" <?php if(isset($_GET["vid"])){echo "value='".$db['seats']."'";}?>><br>
            <input type="text" name="model"placeholder="Vehicle Model" <?php if(isset($_GET["vid"])){echo "value='".$db['model']."'";}?>><br>
            <input type="radio" name="air" id="ac" value="1" <?php if(isset($_GET["vid"])){if($db['air']==1)echo "checked";}?>><label for="ac" >ac</label>
            <input type="radio" name="air" id="nonac" value="0" <?php if(isset($_GET["vid"])){if($db['air']==0)echo "checked";}?>><br>
            <input type="text" name="name" placeholder="Driver Name" <?php if(isset($_GET["vid"])){echo "value='".$db['name']."'";}?>><br>
            <input type="text" name="nic"placeholder="Driver Nic" <?php if(isset($_GET["vid"])){echo "value='".$db['nic']."'";}?>><br>
            <input type="text" name="contact"placeholder="contact number" <?php if(isset($_GET["vid"])){echo "value='".$db['contact']."'";}?>><br>
            <input type="button" id="save" value="Save">
        </form>
    </div>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="../js/vehicle.js"></script>
</body>
</html>