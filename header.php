<?php include_once 'function/functions.php'; ?>
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
<body class="bg-dark">
<div class="bg-light col-md-9 mx-auto">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand order-1" href="#">Grand Hotel</a>
            <?php

            if (isset($_SESSION["currentID"])) {
                $currentID = $_SESSION['currentID'];
                $sql = "SELECT * FROM user WHERE id = '$currentID'";
                $result = $conn->query($sql);
                if ($result->num_rows != 0) {
                    while ($rows = $result->fetch_assoc()) {

                        $fullName = $rows['fullname'];
                        ?>
                        <div class="dropdown order-2">
                            <button class="btn btn-secondary dropdown-toggle float-right" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span><img class="profile-img" src="<?php echo $rows['image'] ?>"> </span>
                                <?php echo $fullName ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="profile.php">Profile</a>
                                <a class="dropdown-item" href="logout.php">Log out</a>
                            </div>
                        </div>
            <?php
                    }
                }

            } else {
                echo '<span class="order-2 login"><a href="login.php">Login</a> or <a href="register.php">sign up</a></span>';
            } ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rooms.php">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Explore Stockholm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="contact-us.php">Contact US</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <header>
            <h1 class="display-2">Gamla Stan (Old town), The capital of vikings</h1>
            <button class="btn btn-primary"><a href="#" class="text-white">Read More</a></button>
        </header>
        <hr>