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
</head>
<body>
<div class="dash-body">
        <div class="dash-section">
            <div class="dash-section-head">
                <div>Routes</div>
                <input type="button" id="create" class="route-add" value="create a new route">
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
                        echo "<input type='button' class='item-delete' value='delete'></div>";

                    }

                ?>
            </div>
        </div>

        <div class="dash-section">
            <div class="dash-section-head">
                <div>Vehicles</div>
                <input type="button" id="cvehi" class="route-add" value="Add new Vehicle">
            </div>
            <div class="dash-section-body">
                <?php
                    $res=mysqli_query($connection,"SELECT * FROM vehicle WHERE u_id='".$_SESSION["id"]."' ORDER BY v_id DESC");
                    foreach($res as $row){
                        echo "<div class='dash-section-body-item'>";
                        echo "<div class='item-name'>".$row["reg_num"]."</div>";
                        echo "<input type='button' class='item-delete' value='delete'></div>";

                    }

                ?>
            </div>
        </div>

    </div>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>