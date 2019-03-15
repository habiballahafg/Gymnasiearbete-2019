<?php

include_once 'header.php';

$sql = "SELECT * FROM room";
$result = $conn->query($sql);

?>
<div class="container">
    <h1>Our rooms:</h1>
    <?php
    if ($result->num_rows != 0) {

        while ($rows = $result->fetch_assoc()) {
            ?>
            <div class="room my-2 mx-2">
                <h2 class="roomTitle"><?php echo $rows['name'] ?></h2>
                <img src="<?php echo $rows['image'] ?>" alt="<?php echo $rows['name'] ?>">
                <p><?php echo $rows['article'] ?></p>
                <button class="btn btn-info mx-2"><a href="#readmore" class="text-white">Read More</a></button>
                <span class="btn btn-danger"><?php echo $rows['price'] ?>$ per night</span>
                <?php
                if ($rows['availability'] >= 1) {
                    $roomID = $rows['id'];
                    ?>
                    <button class="btn btn-primary my-2 mx-2"><a href="booking.php?id=<?php echo $roomID ?>"
                                                                 class="text-white" target="_blank">Book Now</a>
                    </button>
                    <?php
                } else {
                    echo '<button class="btn btn-info disabled my-2 mx-2">Full Booked</button>';
                }
                ?>
            </div>
            <?php
        }
    }
    ?>
</div>
<hr>

<!-- Begin of the popup for more info about rooms -->

<div class="overlay" id="readmore">
    <div class="popup">
        <h2>Create account: </h2>
        <a class="close" href="#">&times;</a>
        <div class="content">
            <div class="container">
                <p><strong>1 Queen Bed</strong>
                    <br>
                    215-sq-foot (20-sq-meter) room with mountain views
                    <br>
                    <strong>Internet</strong> - Free WiFi <img class="img-thumbnail img-icon" src="img/free-wifi.png"
                                                               alt="Free wifi included">
                    <br>
                    <strong>Entertainment</strong> - Flat-screen TV with premium channels
                    <br>
                    <strong>Food & Drink</strong> - Refrigerator, microwave, and coffee/tea maker
                    <br>
                    <strong>Sleep</strong> - Pillowtop bed and premium bedding
                    <br>
                    <strong>Bathroom</strong> - Private bathroom, free toiletries, and a bathtub or shower
                    <br>
                    <strong>Practical</strong> - Desk
                    <br>
                    <strong>Comfort</strong> - Air conditioning, heating, and daily housekeeping
                    <br>
                    <strong>Non-Smoking</strong>
                    <br>

                </p>
            </div>
        </div>
    </div>
</div>

<!-- End of the popup for more info about rooms -->

<?php

include_once 'footer.php';

?>
