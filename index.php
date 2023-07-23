<?php 
    session_start();
    // if(!isset($_SESSION["id"])){
    //     header('Location:signin.php');
    //     exit();
    // }
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
    <title>Bootstrap Dummy Data</title>

    <script src="dashboard/library/autocomplete.js"></script>

    <link rel="stylesheet" href="./styles/login.css" />
    <link rel="stylesheet" href="./styles/footer.css" />
    <link rel="stylesheet" href="./styles/index.css" />
        
    <?php include_once("header.php") ?>

    <!-- Header Section -->
    <?php include_once("searchsection.php");?>

    <section class="container my-5">
      <h2>Section 1</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam
        hendrerit euismod odio, a dictum felis tempus a. Maecenas ultrices
        lectus non massa tincidunt, eget ullamcorper odio aliquam.
      </p>
    </section>

    <section class="bg-light container my-5">
      <h2>Section 2</h2>
      <p>
        Quisque convallis, mauris et dictum auctor, odio velit egestas lacus, at
        auctor libero lectus eu libero. In hac habitasse platea dictumst.
      </p>
    </section>

    <script src="dashboard/library/autocomplete.js"></script>
    <script>
    new Autocomplete(document.getElementById('ori'), {
        data:<?php echo json_encode($data); ?>,
        maximumItems:10,
        highlightTyped:true,
        highlightClass : 'fw-bold text-primary'
    });
    new Autocomplete(document.getElementById('des'), {
        data:<?php echo json_encode($data); ?>,
        maximumItems:10,
        highlightTyped:true,
        highlightClass : 'fw-bold text-primary'
    });     
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <?php include_once("footer.php") ?>
