<?php
    if (isset($_POST['submit'])){
        $userEmail = "";
        $userEmailError = "";
        $userPasswordError = "";
        $userPassword = "";
        $error = false;

        /**
         * Check the email input
         */
        if (isset($_POST['email'])) {
            $userEmail = $_POST['email'];
                // check if e-mail address is well-formed
                if (!filter_var($UserEmail, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                    $error = true;
                }
        }

        /**
         * Check the password input
         */
        if(isset($_POST['password'])){
            $userPassword = $_POST['password'];
            if (strlen($userPassword) < 8){
                $error = true;
                $userPasswordError = "The password cannot be less than 8 character";
            } else {
                //Hash it with BCRYPT.
                $userPassword = password_hash($userPassword, PASSWORD_BCRYPT);
            }
        }

        /**
         * Connect to Database
         */

        $sql = "SELECT fullname FROM user WHERE password = '$userPassword' AND email = '$userEmail'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1){
            while ($row = $result->fetch_assoc()){
            $_SESSION["userFullName"] = $row['fullname'];
            header('Location: index.php');
            }
        }
    }

?>

