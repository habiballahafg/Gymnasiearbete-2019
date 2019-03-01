<?php
include_once '../function/functions.php';

$fullName = $email = $telnr = $password = $address = $country = "";
$fullNameError = $emailError = $telnrError = $passwordError = $countryError = "";
$error = false;

if (isset($_POST['submit'])){

    /**
     * Check the full name field
     */
    if (isset($_POST['fullname'])) {
        $fullName = $_POST['fullname'];
        if (strlen($fullName) < 3) {
            $error = true;
            $fullNameError = "The full name field cannot be less than 3 characters";
        }
        if (!preg_match("/^[a-zA-Z ]*$/",$fullName)) {
            $error = true;
            $fullNameError = "Only letters are allowed.";
        }

    }
    /**
     * Check the email field
     */
    if (isset($_POST['email'])){
        $email = $_POST['email'];

    }

}


?>