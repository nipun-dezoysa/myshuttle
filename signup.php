<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="css/inupbox.css" type="text/css">
    <script src="https://kit.fontawesome.com/296e3cb483.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main-box">
        <div class="pic-box">
            <img src="img/signupcover.png" alt="lady working with laptop">
        </div>
        <div class="form-box">
            <h1>New User!</h1>
            <form name="log" id="input_form">
                <div id="er-name" class="error-m"></div>
                <div class="textin" id="n-box">
                    <input type="text" id="name" name="name" placeholder="your name.">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div id="er-email" class="error-m"></div>
                <div class="textin" id="e-box">
                    <input type="email" id="email" name="email" placeholder="email">
                    <i class="fa-solid fa-at"></i>
                </div>

                <div id="er-phone" class="error-m"></div>
                <div class="textin" id="p-box">
                    <input type="text" id="phone" name="phone" placeholder="phone number">
                    <i class="fa-solid fa-phone"></i>
                </div>

                <div id="er-pass" class="error-m"></div>
                <div class="textin" id="pp-box">
                    <input type="password" id="pass" name="password" placeholder="password">
                    <i class="fa-solid fa-lock"></i>
                </div>

                <div id="er-repass" class="error-m"></div>
                <div class="textin" id="pr-box">
                    <input type="password" id="repass" name="re-password" placeholder="re-password">
                    <i class="fa-solid fa-lock"></i>
                </div>

                <input type="button" name="ok" value="Sign up" id="submit">
            </form>
            <p class="bott-line">Already have an account? <span><a href="signin.php">Sign in</a></span></p>
        </div>
    </div>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="js/signup.js"></script>
</body>
</html>