<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/inupbox.css" type="text/css">

    <link rel="stylesheet" href="./styles/login.css" />
    <link rel="stylesheet" href="./styles/footer.css" />
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="./css/contactus.css" />

    <?php include_once("header.php")?>
    <div class="container">
    <div class="contact-header bg-dark">
        <h1>Your comments are highly appreciated.</h1>
        <div class="contact-links">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-whatsapp"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-twitter"></i></a>
        </div>
    </div>
    </div>
    
    <div class="container display-body">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63381.98859005803!2d79.9214024348224!3d6.845655046978448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2523b05555555%3A0x546c34cd99f6f488!2sNSBM%20Green%20University!5e0!3m2!1sen!2ssg!4v1690385451552!5m2!1sen!2ssg" width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="main-box">
            <div class="pic-box .d-md-none .d-lg-block">
                <img src="img/contactuscover.png" alt="lady working with laptop">
            </div>
            <div class="form-box">
                <div id="success" class="alert alert-success" role="alert">Hurray! message successfully sended</div>
                <div id="warning" class="alert alert-danger" role="alert">Something wrong. try agin later.</div>
                <h1>Talk with an advisor.</h1>
                <form name="log" id="input_form">
                <div id="er-name" class="error-m"></div>
                    <div class="textin" id="n-box">
                        <input type="text" id="name" name="name" placeholder="your name">
                        <i class="fa-solid fa-signature"></i>
                    </div>
                    <div id="er-email" class="error-m"></div>
                    <div class="textin" id="e-box">
                        <input type="email" id="email" name="email" placeholder="your email">
                        <i class="fa-solid fa-at"></i>
                    </div>

                    <div id="er-message" class="error-m"></div>
                    <div class="textin" id="m-box">
                        <textarea name="message" id="message" placeholder="Type your message here."></textarea>
                    </div>

                    <input type="button" id="login" value="Send">
                </form>
            </div>
        </div>
        
    </div>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="js/contactus.js"></script>

    <?php include_once("footer.php")?>