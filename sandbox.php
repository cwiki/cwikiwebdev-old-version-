<?php

/* includes PHP functions, activates the myAutoloader*/
emailValid("c@gmail.com");

/*Validates user email and ensures the length is 8 to 30 chars*/
function emailValid($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && ((strlen($email) <= 30))) {
        echo "evaluated true";
    } else {
echo "evaluated false";
    }
}