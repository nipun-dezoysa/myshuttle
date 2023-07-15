<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="css/inupbox.css" type="text/css">
    <script src="https://kit.fontawesome.com/296e3cb483.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main-box">
        <div class="pic-box">
            <img src="img/logincover.png" alt="lady working with laptop">
        </div>
        <div class="form-box">
            <h1>Hello, Again!</h1>
            <p>We are delighted to have you here. Whether you're a new user or a returning one, we appreciate your presence and value your participation.</p>
            <form name="log" id="input_form">
                <div id="er-email" class="error-m"></div>
                <div class="textin" id="e-box">
                    <input type="email" id="email" name="email" placeholder="your email">
                    <i class="fa-solid fa-at"></i>
                </div>

                <div id="er-pass" class="error-m"></div>
                <div class="textin" id="p-box">
                    <input type="password" id="pass" name="password" autocomplete="current-password" placeholder="password">
                    <i class="fa-solid fa-lock"></i>
                </div>

                <input type="button" id="login" value="Sign in">
            </form>
            <p class="bott-line">Don't have an account? <span><a href="signup.php">Sign up</a></span></p>
        </div>
    </div>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="js/signin.js"></script>
</body>
</html>