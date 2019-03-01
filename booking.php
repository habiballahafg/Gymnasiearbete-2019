<?php

include_once 'header.php';
$roomName;
if (isset($_GET["id"])) {
    $roomName = $_GET["id"];
    switch ($roomName) {
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
?>

<div class="container">
    <?php if ($roomName != false) {
        echo '<h1>' . $roomName . '</h1>';
    } else {
        echo 'Please choose a room from previous page';
    }
    if (isset($_SESSION['userFullName'])) {
        echo "Hello Mr/Mrs" . $_SESSION['userFullName'];
    } else {
        echo '<div class=\"form-group\">' .
        '<form action=\"control/control-booking.php\" method=\"post\">' .
            '<label class=\"col-form-label\" for=\"user-name\">Full Name:</label>' .
           ' <input type=\"text\" class=\"form-control-sm\" id=\"user-name\">' .
            '<br>' .
            '<label class=\"col-form-label\" for=\"user-checkin\">Check in</label>'.
            '<input type=\"date\" class=\"form-control-sm\" id=\"user-checkin\">' .
            '<br>'.
           ' <label for=\"user-checkout\" class=\"col-form-label\">Check out</label>' .
            '<input type=\"date\" id=\"user-checkout\" class=\"form-control-sm\">' .
            '<br>'.
            '<label for=\"user-telnr\">Telephone number: </label>'.
            '<input type=\"tel\" class=\"form-control-sm\" id=\"user-telnr\">'.
            '<br>'.
            '<label for=\"user-address\" class=\"col-form-label\">Address</label>'.
            '<input type=\"text\" class=\"form-control-sm\" id=\"user-address\">'.
            '<br>'.
            '<label for=\"user-password\">Password</label>'.
            '<input type=\"password\" class=\"form-control-sm\" id=\"user-password\">'.
            '<br>'.
            '<label for=\"user-email\">E-mail</label>'.
            '<input type=\"email\" class=\"form-control-sm\" id=\"user-email\">'.
            '<br>'.
            '<input type="checkbox" id="user-agreed" class="form-control-sm">'.
            '<label class="col-form-label mx-2" for="user-agreed">I agree the agreement!</label>'.
            '<input type="submit" class="btn btn-primary" value="sign up">'.
        '</form>'.
    '</div>';
        };
    ?>

</div>
<hr>
<?php

include_once 'footer.php';

?>
