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
    <title>My Shuttle</title>

    <script src="dashboard/library/autocomplete.js"></script>

    <link rel="stylesheet" href="./styles/login.css" />
   
    <link rel="stylesheet" href="./styles/index.css" />
    
        
    <?php include_once("header.php") ?>

    <!-- Header Section -->
    <?php include_once("searchsection.php");?>

    <div class="welcome-mid container">
      <div class="welcome-mid-img">
      <img src="images/indexsloganpass.png" alt="bus washing">
      </div>
      <div class="welcome-mid-des">
      <div class="welcome-note"><span>Welcome </span>to our innovative shuttle service platform! With our user-friendly interface, travelers can effortlessly search for shuttle options between their desired destinations. Whether you're planning a quick city-to-city trip or a scenic countryside journey, our platform provides comprehensive and real-time shuttle results to cater to your needs.
      </div>
      </div>
    </div>

    <div class="container summary">
      <div class="sum-box">
        <div><i class="fa-solid fa-route fa-xl"></i></div>
        <div class="sum-count"><span>
          <?php
          $turnsc = mysqli_query($connection,"select t_id from turn;");
          echo mysqli_num_rows($turnsc);
          ?></span>+</div>
        <div class="sum-sub">Turns</div>
      </div>
      <div class="sum-box">
        <div><i class="fa-solid fa-bus fa-xl"></i></div>
        
        <div class="sum-count"><span>
          <?php
          $turnsc = mysqli_query($connection,"select v_id from vehicle;");
          echo mysqli_num_rows($turnsc);
          ?></span>+</div>
        <div class="sum-sub">Vehicles</div>
      </div>
      <div class="sum-box">
        <div><i class="fa-solid fa-mountain-city fa-xl"></i></div>
        <div class="sum-count"><span>
          <?php
          $turnsc = mysqli_query($connection,"select c_id from city;");
          echo mysqli_num_rows($turnsc);
          ?></span>+</div>
        <div class="sum-sub">Stops</div>
      </div>
    </div>

    
    <div class="welcome-mid container">
      <div class="welcome-mid-des">
        <p>What sets us apart is our inclusive approach, allowing shuttle drivers to actively participate by adding their route details to the platform. This not only benefits travelers with a diverse range of choices but also empowers drivers to expand their reach and grow their businesses.</p>
      </div>
      <div class="welcome-mid-img">
      <img src="images/indexslogan.png" alt="bus washing">
      </div>
    </div>

  
      
    </div>

    <div class="jumbotron">
        <div class="container">
          <div class="row">
            <div class="text-center col-md-8 col-12 mx-auto">
              <p class="lead">"Join the Commuter Community! Share your route and drive the way to a smoother journey. Be a part of our shuttle service platform and help others to reach their destinations with ease"</p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4 col-auto mx-auto"> <a class="btn btn-block btn-lg btn-success" href="signup,php" title="">Sign up now!</a> </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12 mb-2 text-center">
            <h2>Features</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="feature col-sm-6 col-lg-4">
            <h3>Optimized search results</h3>
            <p>Our site's optimized search results utilize a sophisticated algorithm to arrange routes in a user-centric manner, ensuring a seamless experience. Prioritizing relevance and efficiency, our algorithm delivers the most suitable route options, enhancing user satisfaction and making navigation effortless.</p>
            <p><a class="btn btn-link" href="">View details »</a></p>
          </div>
          <div class="feature col-sm-6 col-lg-4">
            <h3>User management system</h3>
            <p>Our user management system empowers individuals to run the site by creating accounts, adding routes, and updating them anytime. Users enjoy full control over their contributions, ensuring dynamic and up-to-date content. This interactive platform fosters community engagement, encouraging seamless sharing and modification of routes. With a user-friendly interface, individuals can effortlessly manage their personalized content, fostering a collaborative and ever-evolving environment for all.</p>
            <p><a class="btn btn-link" href="">View details »</a></p>
          </div>
          <div class="feature col-sm-6 col-lg-4">
            <h3>Self promoting</h3>
            <p>Discover the perfect transport service for your needs or promote your own with our free platform! Seamlessly connect with a thriving community of transport service providers and seekers. Showcase the details of your services and reach a wider audience effortlessly. Find reliable options or boost your business today - it's all possible on our site! Take advantage of this incredible opportunity to enhance your transportation experience without any cost. Join now and revolutionize your transport solutions!</p>
            <p><a class="btn btn-link" href="">View details »</a></p>
          </div>
        </div>
      </div>  

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

    <script src="js/index.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <?php include_once("footer.php") ?>
