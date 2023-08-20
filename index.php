<?php 
  session_start();
	require_once("inc/connection.php");
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

    <link rel="stylesheet" href="css/autocomplete.css" />
    
        
    <?php include_once("header.php") ?>

    <!-- Header Section -->
    <?php include_once("searchsection.php");?>

    <div class="container">Recent added routes,</div>
    <div class="recent-routes container">
      <?php
      $recents = mysqli_query($connection,"SELECT route.r_id, vehicle.reg_num, vehicle.air FROM route INNER JOIN vassign ON route.r_id = vassign.r_id INNER JOIN vehicle ON vassign.v_id=vehicle.v_id ORDER BY route.r_id DESC LIMIT 4;");
      foreach($recents as $reroute){
        $rstart = mysqli_query($connection,"SELECT city.name FROM stops INNER JOIN city On stops.c_id=city.c_id WHERE stops.r_id=".$reroute['r_id']." ORDER BY stops.s_id ASC;");
        $rend = mysqli_query($connection,"SELECT city.name FROM stops INNER JOIN city On stops.c_id=city.c_id WHERE stops.r_id=".$reroute['r_id']." ORDER BY stops.s_id DESC;");
        $startcity = mysqli_fetch_assoc($rstart);
        $endcity = mysqli_fetch_assoc($rend);
      
      ?>
      <a <?php echo "href='routeview.php?id=".$reroute['r_id']."'"; ?> class="recents">
        <div class="recent-img">
          <img src="img/bus.jpg" alt="route bus pic">
        </div>  
        <div class="recent-details">
            <div><?php echo ucfirst($startcity['name'])." - ".ucfirst($endcity['name']);?></div>
            <div>
                <?php 
                  echo $reroute['reg_num']." (";
                  if($reroute['air']==0) echo "non-Ac)";
                  else echo "Ac)";
                ?>
            </div>
        </div>
      </a>
      <?php } ?>
    </div>

    <div class="welcome-mid container">
      <div class="welcome-mid-img">
      <img src="images/indexsloganpass.png" alt="bus washing">
      </div>
      <div class="welcome-mid-des">
      <div class="welcome-note"><span>Welcome </span>to our innovative shuttle service platform! With our user-friendly interface, travelers can effortlessly search for shuttle options between their <span>desired destinations.</span> Whether you're planning a quick city-to-city trip or a scenic countryside journey, our platform provides comprehensive and real-time <span>shuttle results</span> to cater to your needs.
      </div>
      </div>
    </div>

    <div class="container summary">
      <div class="sum-box">
        <div><i class="fa-solid fa-route fa-xl"></i></div>
        <div class="sum-count"><span id="count1">
          <?php
          $turnsc = mysqli_query($connection,"select t_id from turn;");
          echo mysqli_num_rows($turnsc);
          ?></span>+</div>
        <div class="sum-sub">Turns</div>
      </div>
      <div class="sum-box">
        <div><i class="fa-solid fa-bus fa-xl"></i></div>
        
        <div class="sum-count"><span id="count2">
          <?php
          $turnsc = mysqli_query($connection,"select v_id from vehicle;");
          echo mysqli_num_rows($turnsc);
          ?></span>+</div>
        <div class="sum-sub">Vehicles</div>
      </div>
      <div class="sum-box">
        <div><i class="fa-solid fa-mountain-city fa-xl"></i></div>
        <div class="sum-count"><span id="count3">
          <?php
          $turnsc = mysqli_query($connection,"select c_id from city;");
          echo mysqli_num_rows($turnsc);
          ?></span>+</div>
        <div class="sum-sub">Stops</div>
      </div>
    </div>

    
    <div class="welcome-mid container">
      <div class="welcome-mid-des">
        <p>What sets us apart is our inclusive approach, allowing shuttle drivers to <span>actively participate</span> by adding their route details to the platform. This not only benefits travelers with a diverse range of choices but also empowers drivers to <span>expand</span> their reach and grow their businesses.</p>
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
            <div class="col-sm-4 col-auto mx-auto"> <a class="btn btn-block btn-lg btn-success" href="signup.php" title="">Sign up now!</a> </div>
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

      <div class="subscribe container">
        <h1>Subscribe For Updates & Insights.</h1>
        <div class="subscribe-input">
          <input type="email" id="subemail" placeholder="Your email.">
          <input class="button-64" type="button" id="subs" onclick="addsub()" value="Subscribe">
        </div>
      </div>  

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="js/index.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <?php include_once("footer.php") ?>
