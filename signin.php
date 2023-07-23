<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="css/inupbox.css" type="text/css">

    <link rel="stylesheet" href="./styles/login.css" />
    <link rel="stylesheet" href="./styles/footer.css" />
    <link rel="stylesheet" href="./styles/index.css" />

    <?php include_once("header.php")?>

    <div class="container display-body">
        <div class="main-box">
            <div class="pic-box .d-md-none .d-lg-block">
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
    </div>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="js/signin.js"></script>

    <?php include_once("footer.php")?>