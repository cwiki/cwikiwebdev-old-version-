<?php

/**
 * Returns a boolean value after checking to variables
 * SHOWS PAGE If the site setup is enabled
 * OR the current user is an admin
 */
class IsSiteLive extends CRUD
{
    private $isLive;

    function __construct()
    {
    /*Accesses author table and determines if current user is enabled as an admin*/

        /*Accesses setup table and determines if site is already setup to enabled*/
        $setup = $this->dbSelect('setup', 'layout', 'setup');
        $setupBool = $setup['0']['site_live_bool'];

        //check to see if the site level is enabled
        if ($setupBool || $_SESSION['authorized']) {
            $this->isLive = true;
        } else {
            $this->isLive = false;
        }

    }

    function getIsLive()
    {
        return $this->isLive;
    }

}