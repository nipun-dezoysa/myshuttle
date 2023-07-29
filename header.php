    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://kit.fontawesome.com/296e3cb483.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./styles/footer.css" />
    <link rel="icon" type="image/x-icon" href="https://myshuttle.000webhostapp.com/Images/favicon.ico">

  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark nav-color fixed-top">
      <div class="container">
        <a class="navbar-brand logo" href="https://myshuttle.000webhostapp.com/index.php">MYShuttle</a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link" href="https://myshuttle.000webhostapp.com/index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://myshuttle.000webhostapp.com/aboutus.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://myshuttle.000webhostapp.com/contactus.php">Contact</a>
            </li>
          </ul>
          <div class="login-signup">
            <ul class="navbar-nav">
              
              <li class="nav-item">
                <?php
                echo "<a class='nav-link'";
                if(isset($_SESSION["id"])){
                  echo "href='https://myshuttle.000webhostapp.com/dashboard.php'><i class='fa-solid fa-gauge' style='color: #ffffff;'></i> Dashboard</a></li>"; 
                }
                else echo 'href="https://myshuttle.000webhostapp.com/signin.php"><button class="login-btn">Signin</button></a></li>';
                ?>
              <li class="nav-item">
              <?php
                if(isset($_SESSION["id"])){
                  echo '<a class="nav-link" href="https://myshuttle.000webhostapp.com/inc/logout.php"><i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i> Log Out</a>'; 
                }
                else echo '<a class="nav-link" href="https://myshuttle.000webhostapp.com/signup.php"><button class="signup-btn">Sign Up</button></a>';
                ?>
                
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>