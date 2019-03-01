<?php

include_once 'header.php';

?>
    <!--  Begin of the booking section  -->


    <section>
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
        <article>
            <h2>Gamla Stan</h2>
            <img src="img/old-town.jpeg" alt="Old Town(Gamla Stan)" class="img-fluid">
            <p class="my-4">
                Gamla Stan är en av Europas största och bäst bevarade medeltida stadskärnor och en av Stockholms främsta
                attraktioner. Det var här som Stockholm grundades år 1252.
            </p>
            <footer><a href="#">Read More</a></footer>
        </article>
    </div>

    <hr>
    <!-- End of Explore Stockholm -->


    <!-- Begin of Social media icons -->

    <div class="jumbotron">
        <h2 class="social-media">Follow us on Social Media</h2>
        <div class="container">
            <div class="row mx-auto" id="social-media-box">
                <img class="img-thumbnail" src="img/facebook.svg" alt="Like us on Facebook">
                <img class="img-thumbnail" src="img/Twitter.svg" alt="Follow us on Twitter">
                <img class="img-thumbnail" src="img/Instagram.svg" alt="Follow us on Instagram">
                <img class="img-thumbnail" src="img/Youtube.svg" alt="Subscribe us on Youtube">
            </div>
        </div>
    </div>
    <hr>


    <!--  End of social media icons  -->
<?php

include_once 'footer.php';

?>