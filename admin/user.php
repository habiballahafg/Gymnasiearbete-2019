<?php include 'header.php' ?>
<div class="container-fluid px-4 py-4">
        <div class="card">
            <div class="card-title px-4 py-4">
                <h2>User Overview</h2>
                <table class="table px-4 py-4">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>E-mail</th>
                            <th>Telephone Number</th>
                            <th>Address </th>
                            <th>City</th>
                            <th>Zip</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM user";
                        $result = $conn->query($sql);

                        if ($result->num_rows != 0) {
                            while ($rows = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $rows['id']; ?></td>
                                    <td><?php echo $rows['fullname'] ?></td>
                                    <td><a href="mailto:<?php echo $rows['email'] ?>"><?php echo $rows['email'] ?></a></td>
                                    <td><a href="tel:<?php echo $rows['telnr'] ?>"><?php echo $rows['telnr'] ?></a> </td>
                                    <td><?php echo $rows['address']. "<br> " . $rows['address2'] ?></td>
                                    <td><?php echo $rows['city'] ?></td>
                                    <td><?php echo $rows['zip'] ?></td>
                                    <td><?php echo $rows['country']?></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>