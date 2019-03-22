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
                <input type="submit" id="user-submit" class="btn btn-primary mx-2">
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
                        <img src="<?php echo $rows['img'] ?>" alt="<?php echo $rows['title']?>">
                        <p class="font-weight-normal px-4 py-2"><?php echo $rows['post'] ?></p>
                        <footer class="float-left   x   ">
                            <button class="btn btn-primary text-white"><p class="float-left">Published on <?php echo $rows['articledate'] ?></p></button>
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
        <h2 class="social-media mg-4 text-center">Follow us on Social Media</h2>
        
            <div class="row mx-auto text-center px-4" id="social-media-box">
                <img class="img-thumbnail img-social-media" src="img/facebook.svg" alt="Like us on Facebook">
                <img class="img-thumbnail img-social-media" src="img/Instagram.svg" alt="Follow us on Instagram">
                <img class="img-thumbnail img-social-media" src="img/Youtube.svg" alt="Subscribe us on Youtube">
            </div>
    
    </div>
    <hr>


    <!--  End of social media icons  -->
<?php

include_once 'footer.php';

?>