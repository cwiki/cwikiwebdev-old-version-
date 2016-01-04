<?php

/**
 * Checks to see if the splash screen is enabled. Grabs it appropriately.
 */
class GetContent extends CRUD
{

// builds the get request for each page section
    function get_section($section)
    {
        $section .= '.php';

        if (file_exists($section)) {
            include $section;
        } else {
            include 'showcase.php';
        }

    }

    //uses specialized splash request to check boolean and display splash if enabled (recommended)
    function get_splash()
    {

        $setup = $this->dbSelect('setup', 'layout', 'setup');
        $splashBool = $setup['0']['splash_bool'];

        if ($splashBool) {
            $this->get_section('splash');
        }
    }


}