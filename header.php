    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://kit.fontawesome.com/296e3cb483.js" crossorigin="anonymous"></script>

  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">NShuttle</a>
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
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contactUs.html">Contact</a>
            </li>
          </ul>
          <div class="login-signup">
            <ul class="navbar-nav">
              
              <li class="nav-item">
                <?php
                echo "<a class='nav-link'";
                if(isset($_SESSION["id"])){
                  echo "href='dashboard.php'><i class='fa-solid fa-gauge' style='color: #ffffff;'></i> Dashboard</a></li>"; 
                }
                else echo 'href="signin.php"><button class="login-btn">Signin</button></a></li>';
                ?>
              <li class="nav-item">
              <?php
                if(isset($_SESSION["id"])){
                  echo '<a class="nav-link" href="inc/logout.php"><i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i> Log Out</a>'; 
                }
                else echo '<a class="nav-link" href="signup.php"><button class="signup-btn">Sign Up</button></a>';
                ?>
                
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>