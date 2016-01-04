<?php
session_start();

/* includes PHP functions, activates the myAutoloader*/
include 'functions.php';
spl_autoload_register('my_autoloader');


/*REVISION*/
//Requests the setup table
$db = new CRUD();
$setup = $db->dbSelect('setup', 'layout', 'setup');
$setup = $setup['0'];


//grabs as needed classes
$getCont = new GetContent();

//Checks to see if the site is live or if the current user is an admin.
$siteLive = new IsSiteLive();
$siteLive = $siteLive->getIsLive();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <?php enqueue_styles(); ?>

    <title><?php echo $setup['title'] ?></title>
</head>
<body class="fs-default">
<div class="content">
    <?php

    // if statement allows website home page to be toggled on and off.
    if ($siteLive) {

        //checks to see if the splash setup to load
        if (($_POST['getStarted'] || $_COOKIE['getStarted']) == true) {
            //each page load without a splash starts a new cookie for 1hour without a splash
            setcookie("getStarted", true, time() + 3600);
            $doNotSplash = true;
        }


        //Retrieves Splash OR the Content
        if (!$doNotSplash) {
            $getCont->get_splash();
            $getCont->get_section('naviSplash');
        } else {

            //Retrieves Header
            $getCont->get_section('header');


            //Sets the Content to retrieve
            if (isset($_POST['theContent'])) {
                $theContent = $_POST['theContent'];
            } else {
                $theContent = 'default';
            }

            //Retrieves Showcase/Gallery/Contact
            $getCont->get_section($theContent);


            //Retrieves Navigation
            $getCont->get_section('navi');

        }

    } else {

        //Retrieves the site down display
        $getCont->get_section('siteDown');

    }

    ?>
</div>
<!--end of content class-->
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>