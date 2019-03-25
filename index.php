<?php

include_once 'header.php';

?>
    <!--  Begin of the booking section  -->


    <section class="text-center">
        <div class="booking mx-auto">
            <form action="#" class="form-group">
                <label for="room" class="col-form-label-sm">Rooms:</label>
                <select class="form-control-sm">
                    <option value="one">One</option>
                    <option value="two">Two</option>
                    <option value="three">Three</option>
                    <option value="apartment">Apartment</option>
                </select>
                <label for="from-date" class="col-form-label-sm">Check in</label>
                <input type="date" name="from-date" id="from-date" class="form-control-sm mx-2">
                <label for="to-date" class="col-form-label-sm">Check out</label>
                <input type="date" name="to-date" id="to-date" class="form-control-sm mx-2">
                <a href="booking.php" target="_blank" class="btn btn-primary text-white">Submit</a>
            </form>
        </div>
    </section>
    <hr>


    <!--  End of Booking section  -->

    <!-- Begin Explore Stockholm -->
    <div class="col-md">
        <?php
        /* Here we want to show the last article  */
        $sql = "SELECT * FROM article ORDER BY ID DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows != 0) {
            while ($rows = $result->fetch_assoc()) {
                ?>
                <article>
                    <h2><?php echo $rows['title'] ?></h2>
                    <img src="<?php echo $rows['img'] ?>" class="img-fluid" alt="<?php echo $rows['title'] ?>">
                    <p class="font-weight-normal px-4 py-2"><?php echo $rows['post'] ?></p>
                    <footer class="float-left   x   ">
                        <button class="btn btn-primary text-white"><p class="float-left">Published
                                on <?php echo $rows['articledate'] ?></p></button>
                    </footer>
                </article>
                <?php
            }
        }
        ?>
    </div>
    <br>
    <br>
    <hr>
    <!-- End of Explore Stockholm -->


    <!-- Begin of Social media icons -->

    <div class="jumbotron jumbotron-fluid px-4">
        <h2 class="social-media-font text-center">Follow us on Social Media</h2>
        <div class="row">
            <div class="mx-auto text-center " id="social-media-box">
                <img class="social-media" src="img/facebook.svg"
                     alt="Follow us on Instagram">
                <img class="social-media" src="img/Instagram.svg"
                     alt="Follow us on Instagram">
                <img class="social-media"
                     src="img/Youtube.svg"
                     alt="Subscribe us on Youtube">
            </div>
        </div>
    </div>
    <hr>


    <!--  End of social media icons  -->
<?php

include_once 'footer.php';

?>