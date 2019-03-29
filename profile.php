<?php
include_once 'header.php';
$userID = "";
if (isset($_SESSION['currentID'])) {
    $userID = $_SESSION['currentID'];
    /**
     * I create the profile page here if the user is logged in so he/she will have access
     * otherwise the user must be redirected to login page.
     */


    /**
     * Update the name field if it's changed.
     */
    $fullName = $email = $telnr = $password = $address = $address2 = $city = $zip = $country = $agreement = "";
    $fullNameError = $emailError = $telnrError = $passwordError = $addressError = $address2Error = $cityError = $zipError = $countryError = $agreementError = "";
    $error = false;
    $succedMSG = $errorMSG = "";
    $sql = "";
    if (isset($_POST['submit'])) {

        /**
         * Securing the input
         */
        $fullName = test_input($_POST['fullname']);
        $email = test_input($_POST['email']);
        $telnr = test_input($_POST['telnr']);
        $address = test_input($_POST['address']);
        $address2 = test_input($_POST['address2']);
        $city = test_input($_POST['city']);
        $zip = test_input($_POST['zip']);
        $country = test_input($_POST['country']);

        /**
         * Check the field name:
         */
        if (isset($fullName)) {
            if (empty($fullName)) {
                $error = true;
                $fullNameError = "The full name field cannot be left empty";
            }
            if (strlen($fullName) < 3) {
                $error = true;
                $fullNameError = "The full name field cannot be less than 3 characters";
            }
            if (!preg_match("/^[a-zA-Z ]*$/", $fullName)) {
                $error = true;
                $fullNameError = "Only letters are allowed.";
            }
        }
        /**
         * Check the email address field:
         */

        if (!empty($email)) {
            if (empty($email)) {
                $error = true;
                $emailError = "The email field must be filled.";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = true;
                $emailError = "The email address you've entered is not legal.";
            }
        } else {
            $error = true;
            $emailError = "The email field cannot be left empty";
        }
        /**
         * Check the telnr field:
         */
        if (!empty($telnr)) {
            if (strlen($telnr) < 6) {
                $error = true;
                $telnrError = "The telephone number is not valid.";
            }
        } else {
            $error = true;
            $telnrError = "The telepgone number field cannot be left empty";
        }

        /**
         * check the address field:
         */
        if (!empty($address)) {
            if (strlen($address) < 5) {
                $error = true;
                $addressError = "The address field canno be less than 5 characters";
            }
        } else {
            $error = true;
            $addressError = "The address field cannot be left empty";
        }
        /**
         * Check the city field:
         */
        if (empty($city)) {
            $error = true;
            $cityError = "The city name cannot be lefr empty.";
        }
        /**
         * Check the zip code:
         */
        if (empty($zip)) {
            $error = true;
            $zipError = "The postal code is required";
        }

        /**
         * check all errors are corrected now and submit them / insert them into the database
         * Table: user
         */
        if ($error === false) {
            $sql = "UPDATE user SET fullname = '$fullName', email = '$email', telnr= '$telnr', address= '$address', 
            address2= '$address2', zip ='$zip', city = '$city', country='$country' WHERE id='$userID'";

            if ($conn->query($sql) === true) {
                $succedMSG = "Your information has been updated successfully.";
            } else {
                $errorMSGr = "Error: " . $sql . "<br>" . mysqli_error($conn);
                if ($conn->connect_errno) {
                    print_r($conn->connect_error);
                }
            }
        }
    } ?>
    <div class="row">
        <div class="col-4">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                   href="#list-home" role="tab" aria-controls="home">Profile</a>
                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                   href="#list-profile" role="tab" aria-controls="profile">Bookings</a>
                <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list"
                   href="#list-messages" role="tab" aria-controls="messages">Settings</a>
            </div>
        </div>
        <div class="col-8 profile-card">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    <div class="card" style="width: 18rem;">
                        <?php
                        $userSQL = "SELECT * FROM user WHERE id='$userID'";
    $userResult = $conn->query($userSQL);
    if ($userResult->num_rows != 0) {
        while ($userRows = $userResult->fetch_assoc()) {
            ?>
                        <img class="card-img-top" src="img-profile/user-large.png" alt="Card image cap">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $userRows['fullname'] ?></h5>
                            <p class="card-text">Lives
                                at <?php echo $userRows['address'] . " " . $userRows['address2'] ?> </p>
                            <?php
        }
    } ?>

                            <a href="explore.php" class="btn btn-primary">Explore Stockholm</a>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                    <?php
                    $orderSQL = "SELECT * FROM guest WHERE userID ='$userID'";
    $orderResult = $conn->query($orderSQL);
    if ($orderResult->num_rows != 0) {
        while ($orderRows = $orderResult->fetch_assoc()) {
            ?>


                            <div class="jumbotron">
                                <div class="row">

                                    <div class="col-3">
                                        <?php
                                        $roomID = $orderRows['roomID'];
            $roomSQL = "SELECT * FROM room WHERE id='$roomID'";
            $roomResult = $conn->query($roomSQL);
            if ($roomResult->num_rows != 0) {
                while ($roomRows = $roomResult->fetch_assoc()) {
                    ?>
                                        <img class="img-fluid" src="<?php echo $roomRows['image'] ?>">
                                    </div>
                                    <div class="col-9">
                                        <h1><?php echo $roomRows['name'] ?></h1>

                                        <?php
                }
            } ?>

                                        <ul>
                                            <li>Check In: <strong><?php echo $orderRows['checkin'] ?></strong></li>
                                            <li>Check Out: <strong><?php echo $orderRows['checkout'] ?></strong></li>
                                            <li>Order number: <strong class="text-uppercase"><?php echo $orderRows['userOrder'] ?></strong>            </li>
                                        </ul>
                                        <p>Remember that the check in time is everyday between 12-16.</p>
                                        <button class="btn btn-primary"><a href="deleteorder.php?id=<?php echo $orderRows['id'] ?>" class="text-white">Cancel</a> </button>
                                    </div>
                                </div>
                            </div>

                            <?php
        }
    } ?>
                </div>

                <div class="tab-pane fade float-left col-8" id="list-messages" role="tabpanel"
                     aria-labelledby="list-messages-list">
                    <h2>Update your settings</h2>
                    <table class="table">
                        <tbody>
                        <tr id="table-edit">
                            <?php
                            $userID = $_SESSION['currentID'];
    $sql = "SELECT * FROM user WHERE id= '$userID'";
    $result = $conn->query($sql);
    if ($result->num_rows != 0) {
        while ($rows = $result->fetch_assoc()) {
            ?>
                            <form method="post" action="profile.php">
                                <th scope="row">Your name</th>
                                <td><input type="text" class=" form-control-sm" name="fullname"
                                           value="<?php echo $rows['fullname'] ?>"></td>
                                <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                    <input type="submit" name="fullNameSubmit" class="btn btn-primary confirm-icon">
                                </td>
                                <td class="text text-danger"><?php echo $fullNameError ?></td>

                        </tr>
                        <tr>
                            <th scope="row">Your e-mail address</th>
                            <td><input type="email" class="form-control-sm" value="<?php echo $rows['email']; ?>"
                                       name="email"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                        </tr>

                        <tr>
                            <th scope="row">Your telephone number</th>
                            <td><input type="text" name="telnr" class="form-control-sm"
                                       value="<?php echo $rows['telnr']; ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                            <td><input type="text" name="address" class="form-control-sm"
                                       value="<?php echo $rows['address']; ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                        </tr>
                        <tr>
                            <th scope="row">Your optional address</th>
                            <td><input type="text" name="address2" class="form-control-sm"
                                       value="<?php echo $rows['address2']; ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                        </tr>
                        <tr>
                            <th scope="row">City</th>
                            <td><input type="text" name="city" class="form-control-sm"
                                       value="<?php echo $rows['city']; ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                        </tr>
                        <tr>
                            <th scope="row">Zip</th>
                            <td><input type="text" name="zip" class="form-control-sm"
                                       value="<?php echo $rows['zip']; ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                        </tr>
                        <tr>
                            <th scope="row">Your telephone number</th>
                            <td><input type="text" name="country" class="form-control-sm"
                                       value="<?php echo $rows['country']; ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" class="btn btn-primary" name="submit"></td>
                        </tr>
                        </form>
                        <?php
        }
    } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
        header("Location: login.php");
    }
?>
<script language="JavaScript">
    const editIcon = document.querySelector('.edit-icon');
    const confirmIcon = document.querySelector('.confirm-icon');
    const tableEdit = document.getElementById('table-edit');

    editIcon.addEventListener('click', () => {
        editIcon.style.display = 'none';
        confirmIcon.style.display = 'inline';
    });// end addEventListener

    confirmIcon.addEventListener('click', () => {
        confirmIcon.style.display = "none";
        editIcon.style.display = "inline";
    }); // end addEventListener


</script>


<?php
include_once 'footer.php';
?>
