<?php

/**
 * This Class is for authorizing admins
 *
 *
 * Checks post elements for username and password.
 *
 * if isset, attempts to verify in password hash in Database
 *
 * sets the $_SESSION['authorized'] Variable to true or false.
 *
 * sets the $_SESSION['username'] value if authenticated
 *
 * No return values
 *
 */
class AuthorizeAdmin extends CRUD
{

    /*Used as final authorization answer*/
    private $authorized = false;



    /*Does all of the heavy lifting and calls other members of class*/
    function __construct()
    {

        /*Grabs the current username
        Uses the POST first*/
        if ( (isset($_POST['username'])) && (isset($_POST['password'])) ) {

            /*Attempts to authenticate POST password*/
            $this->authenticatePassword();

            if ($this->authorized == true) {
                $_SESSION['authorized'] = true;
            }

        } else {

            /*No username and password pair to try*/
        $_SESSION['authorized'] = false;
        }
    }


    /*Authenticates current username and password set in POST*/
    private function authenticatePassword()
    {
        /*grab the user password hash*/
        $author = $this->dbSelect('author', 'username', $_POST['username']);
        $userHash = $author['0']['password_hash'];


        /*checking hashed passwords against each other*/
        if (password_verify($_POST['password'], $userHash)) {
            $this->authorized = true;

            /*saves the username in session*/
            $_SESSION['username'] = $_POST['username'];
        } else {
            $this->authorized = false;
        }
    }


    /*Returns Authorized Status*/
//    function isAuthenticated(){
//        return $this->authorized;
//    }
}