<?php

/**
 * Determines if a user is logged
 *
 * returns the username
 */
class Username
{
    private $username = 'guest';

//determines if a user is logged in or sets default of guest

    function __construct()
    {
        if (isset($_SESSION['username'])) {
            $this->username = $_SESSION['username'];
        }
    }

    function getUserName()
    {
        return $this->username;
    }

}