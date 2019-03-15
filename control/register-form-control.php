<?php
include_once '../function/functions.php';

$fullName = $email = $telnr = $password = $address = $country = "";
$fullNameError = $emailError = $telnrError = $addressError = $passwordError = $countryError = "";
$error = false;

if (isset($_POST['submit'])){
    if (isset($_POST['agreement'])){
        $_SESSION['agreementError'] = "You must be agree with our conditions";
        header("Location: index.php");
    }
    /**
     * Check the full name field
     */
    if (isset($_POST['fullname'])) {
        $fullName = test_input($_POST['fullname']);
        if (empty($fullName)) {
            $error = true;
            $fullNameError = "The full name field cannot be left empty";
            $_SESSION['fullNameError'] = $fullNameError;
            header("Location: index.php");
        }
        if (strlen($fullName) < 3) {
            $error = true;
            $fullNameError = "The full name field cannot be less than 3 characters";
            $_SESSION['fullNameError'] = $fullNameError;
            header("Location: index.php");
        }
        if (!preg_match("/^[a-zA-Z ]*$/",$fullName)) {
            $error = true;
            $fullNameError = "Only letters are allowed.";
            $_SESSION['fullNameError'] = $fullNameError;
            header("Location: index.php");
        }

    }
    /**
     * Check the email field
     */
    if (isset($_POST['email'])){
        $email = test_input($_POST['email']);
        if (empty($email)){
            $error = true;
            $emailError = "The email field cannot be left empty";
            $_SESSION['emailError'] = $emailError;
            header("Location: index.php");
        }
        if (empty($email)){
            $error = true;
            $emailError = "The email field must be filled.";
            $_SESSION['emailError'] = $emailError;
            header("Location: index.php");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = true;
            $emailError = "The email address you've entered is not legal.";
            $_SESSION['emailError'] = $emailError;
            header("Location: index.php");
        }
    }
    /**
     * Check the password field
     */
    if (isset($_POST['password'])) {
        $password = test_input($_POST['password']);
        if (empty($password)) {
            $error = true;
            $passwordError = "The password field cannot be left empty";
            $_SESSION['passwordError'] = $passwordError;
            header("Location: index.php");
        }
        if (strlen($password) < 8){
            $error = true;
            $passwordError = "The password must contain at least 8 characters";
            $_SESSION['passwordError'] = $passwordError;
            header("Location: index.php");
        }
        $password = password_hash($password, PASSWORD_BCRYPT);
    }
    /**
     * check the telephone number
     */
    if (isset($_POST['telnr'])) {
        $telnr = test_input($_POST['telnr']);
        if (empty($telnr)) {
            $error = true;
            $telnrError = "The telephone number field cannot be left empty";
            $_SESSION['telnrError'] = $telnrError;
            header("Location: index.php");
        }
        if (strlen($telnr) < 6){
            $error = true;
            $telnrError = "The telephone number is not valid.";
            $_SESSION['telnrError'] = $telnrError;
            header("Location: index.php");
        }
    }
    /**
     * Check the address field
     */
    if ($_POST['address']){
        $address = test_input($_POST['address']);

        if (empty($address)){
            $error = true;
            $addressError = "The address field cannot be left empty";
            $_SESSION['addressError'] = $addressError;
            header("Location: index.php");
        }
        if (strlen($address) < 15) {
            $error = true;
            $addressError = "The address must contain at least 15 character";
            $_SESSION['addressError'] = $addressError;
            header("Location: index.php");
        }
    }
    /**
     * Check the country field
     */
    if (isset($POST['country'])){
        $country = $_POST{'country'};
        if (empty($country)){
            $error = true;
            $countryError = "The country field cannot be empty";
            $_SESSION['countryError'] = $countryError;
            header("Location: index.php");

        }
    }

    if ($error === false) {
        $sql = "INSERT INTO user (fullname, email, password, telnr, address, country)
VALUES ('$fullName', '$email', '$password', '$telnr', '$address', '$country')";
        if ($conn->query($sql) == true){
            $_SESSION["userFullName"] = $fullName;
            header("Location: index.php");
        } else {
            $_SESSION["submitError"] = "Something went wrong, please try again later";
            header("Location: index.php");
        }
    }
}





?>