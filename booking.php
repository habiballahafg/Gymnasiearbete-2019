<?php

include 'header.php';
$roomName = $roomID = "";
if (isset($_SESSION['currentID'])) {
    $currentID = test_input($_SESSION['currentID']);
}


/**
 * process the booking here,
 * we get 2 different days and subtractt them to get the final result which is number of days the customer wants to stay
 * in hotel.
 */
$checkin = $checkout = "";
$checkinError = $checkoutError = "";
$subtractingDates = $subtractingError = "";
$selectedRoom = "";
$error = false;
$userOrder = "";
$succesMSG = $errorMSG = "";


if (isset($_POST['submit'])) {

    /**
     * secure the inputs checkin, checkout
     */
    $checkin = test_input($_POST['checkin']);
    $checkout = test_input($_POST['checkout']);
    $selectedRoom = test_input($_POST['select-room']);

    /**
     * check the checkin date input
     */
    if (empty($checkin)) {
        $error = true;
        $checkinError = "Please choose a date for check in";
    }

    /**
     * check the checkout input
     */
    if (empty($checkout)) {
        $error = true;
        $checkoutError = "Please choose a date for check out";
    }

    $username = "";
    $currentUserNameSQL = "SELECT fullname FROM user WHERE id = '$currentID'";
    $currentUserNameResult = $conn->query($currentUserNameSQL);
    if ($currentUserNameResult->num_rows != 0) {
        while ($currentUserNameRows = $currentUserNameResult->fetch_assoc()) {
            $username = $currentUserNameRows['fullname'];
        }
    }

    /**
     * We need to check if the check out date is bigger than checkin date, we do it by subtracting these 2 days
     * and if the result is minus so the error is true
     */
    $subtractingDates = (strtotime($checkout) - strtotime($checkin)) / 86400;
    if ($subtractingDates <= 0) {
        $error = true;
        $subtractingError = "The check out day must be bigger than check in date";
    } else if ($subtractingDates == 0) {
        $error = true;
        $subtractingError = "Difference between check in and out dates must be at least 1 day.";
    }

    if ($error === false) {
        $roomSQL = "SELECT * FROM room WHERE id= '$selectedRoom'";
        $roomResult = $conn->query($roomSQL);
        if ($roomResult->num_rows != 0) {
            while ($roomRows = $roomResult->fetch_assoc()) {
                $roomAvailable = $roomRows['availability'];
                $roomAvailable -= 1;

                $updateSQL = "UPDATE room SET availability= '$roomAvailable' WHERE id= '$selectedRoom'";
                if ($conn->query($updateSQL) === true) {
                    $userOrder = generateRandomString(6);
                    $bookSql = "INSERT INTO guest(userID, roomID, userOrder, checkin, checkout, progress)" . "VALUES('$currentID', '$selectedRoom', '$userOrder', '$checkin', '$checkout', 0)";
                    if ($conn->query($bookSql) === true) {
                        $succesMSG = "We have registered your order successfully.";
                    } else {
                        $errorMSG = "There is a problem with placing your order, please contact us" . $conn->error;
                    }
                }
            }
        }
    }
}
?>

<div class="container">
    <?php
    if (isset($_SESSION['currentID'])) {
        $currentID = $_SESSION['currentID'];
        $sql = "SELECT * FROM user where id = '$currentID'";
        $result = $conn->query($sql);
        if ($result->num_rows != 0) {
            while ($rows = $result->fetch_assoc()) {
                ?>
                <div class="form-group">
                    <form method="post" action="booking.php">
                        <label class="col-form-label">Select a room</label>
                        <select class="custom-select" name="select-room">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label class="text text-danger"><?php echo $checkinError ?></label>
                        <label for="user-checkin" class="label-info">Check In:</label>
                        <input type="date" class="form-control my-2" name="checkin" id="user-checkin">

                        <label class="text text-danger"><?php echo $checkoutError ?></label>
                        <label for="user-checkout" class="label-info">Check Out:</label>
                        <input type="date" class="form-control my-2" name="checkout" id="user-checkout">

                        <label class="label-info"><?php echo $rows['fullname'] ?></label>
                        <br>
                        <label class="label-info"><?php echo $rows['telnr'] ?></label>
                        <br>
                        <input type="submit" class="btn btn-primary" name="submit" value="Book! ">
                        <br>
                        <label class="text text-success"><?php echo $succesMSG ?></label>
                        <label class="text text-danger"><?php echo $errorMSG ?></label>
                    </form>
                </div>
                <?php
            }
        }
    } else {
        ?>
        <p class="text text-cyan">In order to book a room or edit your booked rooms, <a
                    href="login.php"><strong>login</strong></a> or <a href="register.php"><strong>create an account
                    here</strong></a></p>
        <?php
    }
    ?>

</div>
<hr>
<?php

include_once 'footer.php';

?>
