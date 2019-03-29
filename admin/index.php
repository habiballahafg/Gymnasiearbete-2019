
<?php include 'header.php' ?>
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">

            <!-- Row for the order summary -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Order Summary</h4>
                                    <h5 class="card-subtitle">Overview of the most recent order</h5>
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="table-responsive">
                                                <table id="zero_config" class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Order nr</th>
                                                        <th>Room</th>
                                                        <th>Room Type</th>
                                                        <th>Check In</th>
                                                        <th>Check Out</th>
                                                        <th>Progress</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <?php
                                                        $orderSQL = "SELECT * FROM guest";
                                                        $result = $conn->query($orderSQL);
                                                        if ($result->num_rows != 0) {
                                                            while ($rows = $result->fetch_assoc()) {
                                                                ?>
                                                                <td><?php echo $rows['id'] ?></td>
                                                                <td><?php
                                                                    $userID = $rows['userID'];
                                                                    $userSQL = "SELECT * FROM user WHERE id ='$userID'";
                                                                    $userResult = $conn->query($userSQL);
                                                                    if ($userResult->num_rows != 0) {
                                                                        while ($userRows = $userResult->fetch_assoc()) {
                                                                         echo $userRows['fullname'];
                                                                        }
                                                                    }
                                                                    ?></td>
                                                                <td class="text-uppercase"><?php echo $rows['userOrder'] ?>
                                                                <td>Undefined</td>
                                                                <td><?php
                                                                        $roomID = $rows['roomID'];
                                                                        switch ($roomID) {
                                                                            case 1:
                                                                                echo "Single Bed";
                                                                                break;
                                                                            case 2:
                                                                                echo "Double Bed";
                                                                                break;
                                                                            case 3:
                                                                                echo "Triple Bed";
                                                                                break;
                                                                            case 4:
                                                                                echo "Apartment";
                                                                                break;
                                                                            default:
                                                                                echo "Undefined";
                                                                                break;
                                                                        }
                                                                    ?></td>
                                                                <td><?php echo $rows['checkin'] ?></td>
                                                                <td><?php echo $rows['checkout'] ?></td>
                                                                <td>
                                                                <?php
                                                                switch ($rows['progress']) {
                                                                    case 0:
                                                                    echo "Await";
                                                                    break;
                                                                    case 1:
                                                                    echo "In progress";
                                                                    break;
                                                                    case 2:
                                                                    echo "Completed";
                                                                    break;
                                                                    default:
                                                                    echo "Something went wrong";
                                                                    break;
                                                                } ?>
                                                                </td>
                                                    </tr>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo "There is no order active yet.";
                                                        }
                                                        ?>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Order nr</th>
                                                        <th>Room</th>
                                                        <th>Room Type</th>
                                                        <th>Check In</th>
                                                        <th>Check Out</th>
                                                        <th>Progress</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--  End of the order summary -->


            <!-- Begin of the Room managing -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mx-2">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Our rooms</h4>
                                    <h5 class="card-subtitle">Overview of rooms</h5>
                                    <p>In case of editing or seeing the article and images, please click the <strong>Edit</strong> button</p>
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Basic Datatable</h5>
                                            <div class="table-responsive">
                                                <table id="zero_config" class="table table-striped table-bordered col-mx-10">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Room Type</th>
                                                        <th>Available</th>
                                                        <th>Busy</th>
                                                        <th>Price</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $roomSQL = "SELECT * FROM room";
                                                    $roomResult = $conn->query($roomSQL);
                                                    if ($roomResult->num_rows != 0) {
                                                        while ($roomRows = $roomResult->fetch_assoc()) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $roomRows['id'] ?></td>
                                                                <td><?php echo $roomRows['name'] ?></td>
                                                                <td><?php echo $roomRows['availability'] ?></td>
                                                                <td>
                                                                    <?php
                                                                    $roomAvailable = intval($roomRows['availability']);
                                                            $roomTotal = intval($roomRows['number']);
                                                            $roomBusy = $roomTotal - $roomAvailable;
                                                            echo $roomBusy; ?>
                                                                </td>
                                                                <td><?php echo $roomRows['price'] ?></td>
                                                                <td><a href="room.php?id=<?php echo $roomRows['id'] ?>">
                                                                        <button class="btn btn-primary">Edit</button>
                                                                    </a>
                                                                    <a href="roomdelete.php?id=<?php echo $roomRows['id'] ?>">
                                                                        <button class="btn btn-secondary">Delete
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Room Type</th>
                                                        <th>Available</th>
                                                        <th>Busy</th>
                                                        <th>Price</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Start of Posts section -->
            <div class="row">
                <!-- column -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Latest Posts</h4>
                        </div>
                        <div class="comment-widgets scrollable">
                            <?php
                            $numberOfArticle = "";
                            $sql = "SELECT * FROM article";
                            $result = $conn->query($sql);
                            if ($result->num_rows != 0) {
                                while ($rows = $result->fetch_assoc()) {
                                    ?>
                                    <!-- article Row -->

                                    <div class="d-flex flex-row comment-row m-t-0">
                                        <div class="p-2"><img src="<?php echo $rows['img'] ?>" alt="user"
                                                              width="50" class="rounded-circle"></div>
                                        <div class="comment-text w-100">
                                            <h6 class="font-medium"><?php echo $rows['title'] ?></h6>
                                            <span class="m-b-15 d-block"><?php echo substr($rows['post'], 0, 100) ?></span>
                                            <div class="comment-footer">
                                                <span class="text-muted float-right"><?php echo $rows['articledate'] ?></span>
                                                <button type="button" class="btn btn-cyan btn-sm"><a class="text-white" href="article.php?id=<?php echo $rows['id']?>">Edit</a></button>
                                                <button type="button" class="btn btn-danger btn-sm"><a class="text-white" href="articledelete.php?id=<?php echo $rows['id'] ?>">Delete</a></button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $numberOfArticle = $result->num_rows;
                                }
                            }
                            echo '<p class="text text-success">There are total' .  $numberOfArticle . ' articles</p>';
                            ?>
                        </div>
                    </div>

                </div>
                <!-- column -->

                <div class="col-lg-6">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Users</h4>
                            <p>The number beside the name is the id number of the current user in database table.</p>
                            <div class="chat-box scrollable" style="height:475px;">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Telephone nr</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $userSQL = "SELECT * FROM user";
                                    $userResult = $conn->query($userSQL);
                                    if ($userResult->num_rows != 0) {
                                        while ($userRows = $userResult->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $userRows['id'] ?></td>
                                                <td><?php echo $userRows['fullname'] ?></td>
                                                <td><?php echo $userRows['email'] ?></td>
                                                <td><?php echo $userRows['telnr'] ?></td>
                                                <td><?php echo $userRows['address'] ?></td>
                                                <td><?php echo $userRows['city'] ?></td>
                                                <td><?php echo $userRows['country'] ?></td>
                                                <td><a href="user.php?id=<?php echo $userRows['id'] ?>">
                                                        <button class="btn btn-primary">Edit</button>
                                                    </a>
                                                    <a href="userdelete.php?id=<?php echo $userRows['id'] ?>">
                                                        <button class="btn btn-secondary">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            echo "There are $userResult->num_rows users registered in Database.";
                                        }
                                    } else {
                                        echo "There is no record in database for your request.";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Container fluid  -->
    <?php include 'footer.php' ?>