<?php
session_start();

/* includes PHP functions, activates the myAutoloader*/
include 'functions.php';
spl_autoload_register('my_autoloader');


/*REVISION*/
//Requests the setup table
$db = new CRUD();

//grabs as needed classes
$getCont = new GetContent();

//check for password
if ($_POST['logout'] == true) {

    /*Unsets session variables*/
    $_SESSION = array();

    if (ini_get("session.use_cookies")){
        $params = session_get_cookie_params();
        setcookie(session_name(), '' , time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
            );
    }

    session_destroy();

}

if ($_SESSION['authorized'] == !true) {
    $authorValue = new AuthorizeAdmin();
}


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

    //Retrieves Header
    $getCont->get_section('header');

    //Sets the Content to retrieve
    if ($_SESSION['authorized']) {

        if (isset($_POST['theContent'])) {

            //Retrieves general or article
            $getCont->get_section($_POST['theContent']);
        } else {
            $getCont->get_section('cwiki-general');

        }
        //Retrieves Navigation
        $getCont->get_section('cwiki-navi');


    } else {

        /*If user is un-authorized they are prompted to log in*/
        $getCont->get_section('login');
        /*Put a cap on login attempts*/

    }


    ?>

</div>
<!--end of content class-->
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>