<?php

/**
 *
 * Creates an Author
 * intended to only be accessed from the backend
 *
 *
 * New Author Requirements
 *
 * USERNAME: Checks to make sure it isn't take and between 8 to 20 chars long
 * PASSWORD: * Ensures user password is between 8 and 20 characters long
 * must contain a number, a letter, a capitol
 *
 * NAME: 30 chars long
 *
 * EMAIL:Ensures email is valid and no longer than 30 chars long
 *
 * PHONE: 10 digits long no symbols
 *
 */
class CreateAuthor extends CRUD
{

    private $created = false;
    public $message = "New Author has been successfully created";
    public $errors = array();

    /*Relevant user variables*/


    function __construct()
    {
        $username = $_POST['new-username'];
        $password = $_POST['new-password'];
        $name = $_POST['new-name'];
        $email = $_POST['new-email'];
        $phone_num = $_POST['new-phone'];

        if ($_SESSION['authorized'] == true) {

            /*converts to HTML Special CHARS and determines if available*/
            $usernameAvail = ($this->authUsername($username));

            /*Validates Password Strength*/
            $passwordValid = ($this->authPassword($password));

            /*Validates users name*/
            $nameValid = $this->nameValid($name);

            /*checks formatting and stores password*/
            $emailValid = $this->emailValid($email);

            /*accepts a phone number*/
            $phoneValid = $this->phoneValid($phone_num);

            if ($usernameAvail && $passwordValid && $nameValid && $emailValid && $phoneValid) {
                $this->created = true;


                $values = array(
                    'username' => $username,
                    'password_hash' => crypt($password),
                    'name' => $name,
                    'email' => $email,
                    'phone_num' => $phone_num,
                    'enabled' => '1'

                );
//                $values = array($invalues);


                $this->dbInsert('author', $values);


                /*
                 *
                 * CREATE new Author in the DB Table
                 *
                 * */
                $this->created = true;


            }
        } elseif ($_SESSION['authorized'] == false) {
            $this->errors[] = "You don't have permission to preform this action.";
        } else {
            $this->created = false;
        }
    }


    /*checks for taken username, checks length*/
    private function authUsername($username)
    {
        /*ensures username is not already taken and is valid*/
        $usernameAvail = true;

        /*retrieves matching author names from the database*/
        $author = $this->dbSelect('author', 'username', $username);

        if ((isset($author['0']['username']))) {
            $usernameAvail = false;
            $this->errors[] = "Sorry your username was taken.";
        }
        if (!preg_match('/^[a-zA-Z0-9]{8,20}$/', $username) || (preg_match('/\s/', $username))) {
            $usernameAvail = false;
            $this->errors[] = "Name must be 8 to 20 Characters long numbers or letters";
        }

        /*Returns a boolean*/
        return $usernameAvail;
    }


    /*Ensures user password is between 8 and 20 characters long
     must contain a number, a letter, a capitol.*/

    private function authPassword($password)
    {
        $passAuth = true;

        if (!(strlen($password) >= 8) || !(strlen($password) <= 20)) {
            $this->errors[] = 'Your password needs to be 8 to 20 Characters long.';
            $passAuth = false;
        }

        if (!preg_match("#[0-9]+#", $password)) {
            $this->errors[] = "Your password must include at least one number in your password";
            $passAuth = false;
        }


        if (!preg_match("#[a-z]+#", $password)) {
            $this->errors[] = "Your password must include at least one letter in your password";
            $passAuth = false;
        }


        if (!preg_match("#[A-Z]+#", $password)) {
            $this->errors[] = "Your password must include at least one capitol letter in your password";
            $passAuth = false;
        }
        return $passAuth;
    }

    /*Validates the author's name. Must not be empty up to 30 chars long*/
    private function nameValid($name)
    {
        // for english chars + numbers only
        // valid username, alphanumeric & longer than or equals 5 chars
        if (preg_match('/^[a-zA-Z0-9]{3,20}$/', $name)) {
            $nameValid = true;
        } else {
            $nameValid = false;
            $this->errors[] = "Name must be letter or numbers and 5 to 20 Characters long";
        }
        return $nameValid;
    }

    /*Validates user email and ensures the length is 8 to 30 chars*/
    private function emailValid($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && ((strlen($email) <= 30))) {
            $emailValid = true;
        } else {
            $emailValid = false;
            $this->errors[] = "The email address entered was invalid";
        }
        return $emailValid;
    }

    /*Validates that the number is a int value that is 10 characters long*/
    private function phoneValid($phone_num)
    {

        if (preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone_num)) {
            $phoneValid = true;
        } else {
            $phoneValid = false;
            $this->errors[] = "The number you entered was invalid please use this format 000-000-000";
        }
        return $phoneValid;
    }


    public function getMessage()
    {
        if ($this->created) {
            return $this->message;
        } else {
            return implode("<br>", $this->errors);

        }
    }
}