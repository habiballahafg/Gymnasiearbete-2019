<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Grand Hotel, Book your room online!</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Libre+Baskerville|Varela+Round" rel="stylesheet">
    <!-- CSS Assets -->
    <link rel="stylesheet" href="asset/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="asset/main.css" type="text/css">
</head>
<body class="bg-light">
    <div class="bg-white">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand order-1" href="#">Grand Hotel</a>
        <span class="order-2 login"><a href="#login-form">Login</a> or <a href="#register-form">signup</a> </span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Explore Stockholm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">Contact US</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <header>
        <h1 class="display-2">Gamla Stan (Old town), The capital of wikings</h1>
        <button class="btn btn-primary"><a href="#" class="text-white">Read More</a></button>
    </header>
    <hr>


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


    <!--  Begin of footer  -->
    <footer class="col-lg">
        <p>All right reserved, &copy; Copyright 2019</p>
    </footer>
</div>


<!--  End of footer  -->


<!-- Begin of the JavaScript Assets -->
<script language="JavaScript" src="asset/jquery.js"></script>
<script language="JavaScript" src="asset/bootstrap.js"></script>
<script language="JavaScript" src="asset/mainJS.js"></script>
<noscript>The JavaScript is not activated, please activate the JavaScript. Thanks!</noscript>
<!-- End of the JavaScript Assets -->


<!--  Begin of the register form  -->


<div class="overlay" id="register-form">
    <div class="popup">
        <h2>Create account: </h2>
        <a class="close" href="#">&times;</a>
        <div class="content">
            <div class="container">
                <div class="form-group">
                            <form id="registeration-form" action="control/register-form-control.php" method="post">
                        <input type="text" class="form-control-sm my-2" id="user-full-name" placeholder="Full Name">
                        <br>
                        <input type="email" class="my-2 form-control-sm" id="user-email" placeholder="E-mail Address">
                        <br>
                        <input type="password" class="my-2 form-control-sm" id="user-password" placeholder="Password">
                        <br>
                        <input type="tel" class="my-2 form-control-sm" id="user-telnr" placeholder="Telephone number">
                        <br>
                        <input type="checkbox" class="my-2 form-control-sm"><label>I agree with agreement and privacy
                            policy</label>
                        <br>
                        <input type="submit" id="submit-register" class="my-2 btn btn-primary">
                    </form>
                </div>
            </div>


            <!-- End of the register form  -->


            <!-- Begin of the login form  -->

            <div id="login-form" class="overlay">
                <div class="popup">
                    <h2>Login:</h2>
                    <a class="close" href="#">&times;</a>
                    <div class="content">
                        <div class="container">
                            <form action="#" method="get" class="form-group">
                                <input type="text" class="form-control-sm" placeholder="Username/E-mail">
                                <input type="password" class="form-control-sm" placeholder="Password">
                                <br>
                                <input type="checkbox" id="user-remember-me"> <label for="user-remember-me">Remember
                                    me?</label>
                                <br>
                                <input type="submit" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End of the login form  -->
        </div>
</body>
</html>