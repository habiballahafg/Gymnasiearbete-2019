<?php

include_once 'header.php';
$roomName = $roomID = "";
$currentID = "";
if (isset($_GET["id"])) {
    $roomID = $_GET["id"];
    switch ($roomID) {
        case 1:
            $roomName = 'single bed room';
            break;
        case 2:
            $roomName = 'double bed room';
            break;
        case 3:
            $roomName = 'tripple bed room';
            break;
        case 4:
            $roomName = 'apartment';
            break;
        default:
            $roomName = false;
    }
}
/**
 * process the booking here,
 * we get 2 different days and subtractt them to get the final result which is number of days the customer wants to stay
 * in hotel.
 */
$checkin = $checkout = "";
$checkinError = $checkoutError = "";
$subtractingDates = $subtractingError = "";
$error = false;
$userOrder = "";
$succesMSG = $errorMSG = "";
if (isset($_POST['submit'])) {

    /**
     * secure the inputs checkin, checkout
     */
    $checkin = test_input($_POST['checkin']);
    $checkout = test_input($_POST['checkout']);

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

    /**
     * We need to check if the check out date is bigger than checkin date, we do it by subtracting these 2 days
     * and if the result is minus so the error is true
     */
    $subtractingDates = $checkout - $checkin;
    if ($subtractingDates <= 0) {
        $error = true;
        $subtractingError = "The check out day must be bigger than check in date";
    }

    if ($error == false) {
        $userOrder = generateRandomString();
        $bookSql = "INSERT INTO (userID, roomID, userOrder, checkin, checkout) VALUES('$currentID', '$roomID', '$userOrder', '$checkin', '$checkout')";
        if ($bookResult = $conn->query($bookSql) === true) {
            $roomSQL = "SELECT * FROM room WHERE '$roomID'";
            $roomResult = $conn->query($roomSQL);
            if ($roomResult->num_rows != 0) {
                while ($roomRows = $roomResult->fetch_assoc()) {
                    $availability = $roomRows['availability'];
                    $availability -= 1;
                    $updateRoomSQL = "UPDATE room SET availability = '$availability' WHERE id= '$roomID'";
                    if ($conn->query($updateRoomSQL) === true) {
                        $succesMSG = "You have booked a room successfully, your order number is: " . $userOrder . ". please
                        remeber this order number when you are coming to our hotel." . " <br>" .
                            "Thank you for your booking.";
                    } else {
                        $errorMSG = "Something went wrong, please try again later.";
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
                        <label class="text text-success"><?php echo $succesMSG ?></label>
                        <label class="text text-danger"><?php echo $errorMSG ?></label>
                    </form>
                </div>
                <?php
            }
        }
    } else { ?>
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
