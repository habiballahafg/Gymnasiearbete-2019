<?php include 'header.php' ?>
<div class="container-fluid px-4 py-4">
        <div class="card">
            <div class="card-title px-4 py-4">
                <h2>Order Overview</h2>
                <table class="table px-4 py-4">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Order Number</th>
                            <th>Check In</th>
                            <th>Check Out </th>
                            <th>Progress</th>
                            <th>Room Type</th>
                            <th>Room Number</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM guest";
                        $result = $conn->query($sql);
                        if ($result->num_rows != 0) {
                            while ($rows = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $rows['id'] ?></td>
                                    <td><a href="user.php?id=<?php echo $rows['userID'] ?>"><?php echo $rows['username'] ?></a></td>
                                    <td><?php echo $rows['userOrder'] ?></td>
                                    <td><?php echo $rows['checkin'];
                                        $todayDate = date("Y-m-d");
                                        $differenceDate = (strtotime($rows['checkin']) - strtotime($todayDate)) / 86400;
                                        echo "<p>Approximately about: " . $differenceDate . " days left.</p>";
                                        ?>
                                    </td>
                                    <td><?php echo $rows['checkout'];
                                        $todayDate = date("Y-m-d");
                                        $differenceDate = (strtotime($rows['checkout']) - strtotime($todayDate)) / 86400;
                                        echo "<p>Approximately about: " . $differenceDate . " days left.</p>";
                                        ?>
                                    </td>
                                    <td><?php
                                        switch ($rows['progress']) {
                                            case  0:
                                                echo "Await *";
                                                break;
                                            case 1:
                                                echo "In progress *";
                                                break;
                                            case 2:
                                                echo "Completed *";
                                                break;
                                            default:
                                                echo "Unknown";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php echo $rows['roomtype'] ?></td>
                                    <td><?php echo $rows['roomnumber'] ?></td>
                                </tr>
                    <?php
                            }
                        }
                    ?>

                    </tbody>
                </table>
                <ul>
                    <p>* About the progress</p>
                    <li>Await: It means we wait for the check in date. </li>
                    <li>In Progress: The costumer has been checked in successfully.</li>
                    <li>Completed: The costumer has checked out successfully.</li>
                </ul>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>  