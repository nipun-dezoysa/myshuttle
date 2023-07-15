<?php 
    session_start();
    if(!isset($_SESSION["id"])){
        header('Location:signin.php');
        exit();
    }
	require_once("../inc/connection.php");
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Route Plan</title>
    <link rel="stylesheet" href="../css/routeplan.css" type="text/css">
    <script src="https://kit.fontawesome.com/296e3cb483.js" crossorigin="anonymous"></script>

    <link href="library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
    <script src="library/bootstrap-5/bootstrap.bundle.min.js"></script>
    <script src="library/autocomplete.js"></script>
</head>
<body>

    <div class="body-plan">
        <form name="log">
            <div class="plan-select">
                Route type: <input type="radio" name="type" value="shuttle">shuttle <input type="radio" name="type" value="service">service <input type="radio" name="type" value="ctb">ctb
            </div>
            <div class="places" id="places">
            </div>
            <div class="plan-dml">
                <input type="text" id="loc" placeholder="type next stop">
                <input type="button" id="add" value="Add">
                <input type="button" id="delete" value="Delete">
            </div>
            <div class="plan-ok">
                <input type="button" id="save" value="Save">
            </div>
        </form>
    </div>

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="../js/routeplan.js"></script>

    <script>
    var auto_complete = new Autocomplete(document.getElementById('loc'), {
        data:<?php echo json_encode($data); ?>,
        maximumItems:10,
        highlightTyped:true,
        highlightClass : 'fw-bold text-primary'
    });     
    </script>
</body>
</html>