<?php 
    session_start();
    if(!isset($_SESSION["id"])){
        header('Location:../signin.php');
        exit();
    }
	require_once("../inc/connection.php");   
    $result=mysqli_query($connection,"SELECT * FROM city ORDER BY name ASC");
    $data = array();
    foreach($result as $row)
    {
        $data[] = $row['name'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Route Plan</title>
    
    <script src="https://kit.fontawesome.com/296e3cb483.js" crossorigin="anonymous"></script>

    <link href="library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
    <script src="library/bootstrap-5/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../styles/login.css" />
    <link rel="stylesheet" href="../styles/footer.css" />
    <link rel="stylesheet" href="../styles/index.css" />
    <link rel="stylesheet" href="../css/autocomplete.css" />
    <link rel="stylesheet" href="../css/routeplan.css" type="text/css">

    <link rel="stylesheet" href="../css/dashboard.css" type="text/css">

    <?php include_once('../header.php');?>

    <div class="container dash-main">
        <div class="dash-side">
            <a href="../dashboard.php"><div class="dash-links">Dashboard</div></a>
            <div class="dash-links-select">New Route</div>
            <a href="vehicle.php"><div class="dash-links">Add Vehicle</div></a>
        </div>
        <div class="dash-body">
            <div class="body-plan">
                <div class="plan-head">Route Plan</div>
                <form name="log">
                    <div class="plan-select">
                        Route type:<input type="radio" name="type" value="shuttle">shuttle <input type="radio" name="type" value="service">service <input type="radio" name="type" value="ctb">ctb
                    </div>
                    <div class="places" id="places"></div>
                    <div class="plan-dml">
                        <div class="autocomplete"><input type="text" autocomplete="off" id="loc" placeholder="type next stop"></div>
                        <input type="button" class="butt-add" id="add" value="Add">
                        <input type="button" class="butt-delete" id="delete" value="Delete">
                    </div>
                    <div class="plan-ok">
                        <input type="button" class="butt-add" id="save" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>

    

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="../js/routeplan.js"></script>
    <script src="../js/autocomplete.js"></script>
    <script>
      var countries = <?php echo json_encode($data); ?>;
      autocomplete(document.getElementById("loc"), countries);
    </script>

    <?php include_once('../footer.php');