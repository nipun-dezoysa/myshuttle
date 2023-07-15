<?php session_start();
    if(!isset($_SESSION["id"])){
        header('Location:signin.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/inupbox.css" type="text/css">
    <script src="https://kit.fontawesome.com/296e3cb483.js" crossorigin="anonymous"></script>
</head>
<body>
    <input type="button" id="create" value="Create a route">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>