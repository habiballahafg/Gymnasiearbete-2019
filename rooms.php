<?php

include_once 'header.php';


?>

<div class="container">
    <h1>Our rooms:</h1>
    <div class="room my-2 mx-2">
        <h2>Single Bed Room</h2>
        <img src="img/single-bed.jpg" alt="Single Bed Room">
        <p>Jump-start your day with a good night’s sleep. With the comfort and quality you get from our sturdy single
            beds, you’ll wake up refreshed and ready to roll. To make more of your space, go for a storage bed or one
            that you can slide underbed storage underneath. And we have everything else, like a mattress or a duvet, to
            complete your bed in style.</p>
        <button class="btn btn-info mx-2"><a href="#readmore" class="text-white">Read More</a></button>
        <span class="btn btn-danger">75$ per night</span>
        <?php
        $sql = "SELECT availability FROM room WHERE id = 1";
        $result = $conn->query($sql);
        if ($result->num_rows != 0) {
            while ($row = $result->fetch_assoc()) {
                $roomAvailability = $row['availability'];
                if ($roomAvailability >= 1) {
                    echo '<button class="btn btn-primary my-2 mx-2"><a href="booking.php?id=1" class="text-white" target="_blank">Book Now</a></button>';
                } else {
                    echo '<button class="btn btn-info disabled my-2 mx-2">Full Booked</button>';
                }
            }
        }
        ?>
    </div>
    <div class="room my-2 mx-2">
        <h2>Double Bed Room</h2>
        <img src="img/double-bed.jpg" alt="Double Bed Room">
        <p>Jump-start your day with a good night’s sleep. With the comfort and quality you get from our sturdy single
            beds, you’ll wake up refreshed and ready to roll. To make more of your space, go for a storage bed or one
            that you can slide underbed storage underneath. And we have everything else, like a mattress or a duvet, to
            complete your bed in style.</p>
        <button class="btn btn-info mx-2"><a href="#readmore" class="text-white">Read More</a></button>
        <span class="btn btn-danger">120$ per night</span>
        <?php
        $sql = "SELECT availability FROM room WHERE id = 2";
        $result = $conn->query($sql);
        if ($result->num_rows != 0) {
            while ($row = $result->fetch_assoc()) {
                $roomAvailability = $row['availability'];
                if ($roomAvailability >= 1) {
                    echo '<button class="btn btn-primary my-2 mx-2"><a href="booking.php?id=2" class="text-white" target="_blank">Book Now</a></button>';
                } else {
                    echo '<button class="btn btn-info disabled my-2 mx-2">Full Booked</button>';
                }
            }
        }
        ?>
    </div>
    <div class="room my-2 mx-2">
        <h2>Tripple Bed Room</h2>
        <img src="img/tripple-bed.jpg" alt="Tripple Bed Room">
        <p>Jump-start your day with a good night’s sleep. With the comfort and quality you get from our sturdy single
            beds, you’ll wake up refreshed and ready to roll. To make more of your space, go for a storage bed or one
            that you can slide underbed storage underneath. And we have everything else, like a mattress or a duvet, to
            complete your bed in style.</p>
        <button class="btn btn-info mx-2"><a href="#readmore" class="text-white">Read More</a></button>
        <span class="btn btn-danger">180$ per night</span>
        <?php
        $sql = "SELECT availability FROM room WHERE id = 3";
        $result = $conn->query($sql);
        if ($result->num_rows != 0) {
            while ($row = $result->fetch_assoc()) {
                $roomAvailability = $row['availability'];
                if ($roomAvailability >= 1) {
                    echo '<button class="btn btn-primary my-2 mx-2"><a href="booking.php?id=3" class="text-white" target="_blank">Book Now</a></button>';
                } else {
                    echo '<button class="btn btn-info disabled my-2 mx-2">Full Booked</button>';
                }
            }
        }
        ?>
    </div>
    <div class="room my-2 mx-2">
        <h2>Apartment</h2>
        <img src="img/apartment.jpg" alt="Apartment">
        <p>Jump-start your day with a good night’s sleep. With the comfort and quality you get from our sturdy single
            beds, you’ll wake up refreshed and ready to roll. To make more of your space, go for a storage bed or one
            that you can slide underbed storage underneath. And we have everything else, like a mattress or a duvet, to
            complete your bed in style.</p>
        <button class="btn btn-info mx-2"><a href="#readmore" class="text-white">Read More</a></button>
        <span class="btn btn-danger">250$ per night</span>
        <?php
        $sql = "SELECT availability FROM room WHERE id = 4";
        $result = $conn->query($sql);
        if ($result->num_rows != 0) {
            while ($row = $result->fetch_assoc()) {
                $roomAvailability = $row['availability'];
                if ($roomAvailability >= 1) {
                    echo '<button class="btn btn-primary my-2 mx-2"><a href="booking.php?id=4" class="text-white" target="_blank">Book Now</a></button>';
                } else {
                    echo '<button class="btn btn-info disabled my-2 mx-2">Full Booked</button>';
                }
            }
        }
        ?>
    </div>
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
