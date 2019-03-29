<?php include 'header.php';
$fullname = $email = $telnr = $address = $address2 = $zip = $city = $country = $accesslevel = "";
$fullnameError = $emailError = $telnrError = $addressError = $address2Error = $zipError = $cityError = $countryError = $accesslevelError = "";
$successMSG = $errorMSG = "";
$error = false;
if (isset($_POST['submit'])) {

    /**
     * Secure the input
     */
    $fullname = test_input($_POST['fullname']);
    $email = test_input($_POST['email']);
    $telnr = test_input($_POST['telnr']);
    $address = test_input($_POST['address']);
    $address2 = test_input($_POST['address2']);
    $zip = test_input($_POST['zip']);
    $city = test_input($_POST['city']);
    $country = test_input($_POST['country']);
    $accesslevel = test_input($_POST['accesslevel']);

    $sql = "UPDATE user SET fullname='$fullname', email='$email', telnr= '$telnr', $address='$address', 
            address2='$address2', zip='$zip', city='$city', country='$country', accesslevel='$accesslevel' WHERE id='$userID'";
    if ($conn->query($sql) === true) {
        echo "Your changes have been updated successfully.";
    }
}


if (isset($_GET['id'])) {
    $userID = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id= '$userID'";
    $result = $conn->query($sql);
    if ($result->num_rows != 0) {
        while ($rows = $result->fetch_assoc()) {
            ?>
            <div class="container-fluid px-4 py-4">
                <div class="card">
                    <div class="card-title px-4 py-4">
                        <h2>User Overview</h2>
                        <form method="post" action="user.php">
                            <div class="form-group">
                                <label for="fullname">Full name:</label>
                                <label for="fullname"><?php if (isset($fullnameError)) {
                                        echo $fullnameError;
                                    } ?></label>
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                       value="<?php echo $rows['fullname'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <label for="email"><?php if (isset($emailError)) {
                                        echo $emailError;
                                    } ?></label>
                                <input type="email" class="form-control" name="email" id="email"
                                       value="<?php echo $rows['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="telnr">Telephone number:</label>
                                <label for="telnr"><?php if (isset($telnrError)) {
                                        echo $telnrError;
                                    } ?></label>
                                <input type="tel" class="form-control" name="telnr" id="telnr"
                                       value="<?php echo $rows['telnr'] ?>"></div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <label for="address"><?php if (isset($addressError)) {
                                        echo $addressError;
                                    } ?></label>
                                <input type="text" class="form-control" name="address" id="address"
                                       value="<?php echo $rows['address'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="address2">Optional Address:</label>
                                <label for="address2"><?php if (isset($address2Error)) {
                                        echo $address2Error;
                                    } ?></label>
                                <input type="text" class="form-control" name="address2" id="address2"
                                       value="<?php echo $rows['address2'] ?>"></div>
                            <div class="form-group">
                                <label for="zip">Zip:</label>
                                <label for="zip"><?php if (isset($zipError)) {
                                        echo $zipError;
                                    } ?></label>
                                <input type="text" class="form-control" name="zip" id="zip"
                                       value="<?php echo $rows['zip'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="city">City:</label>
                                <label for="city"><?php if (isset($cityError)) {
                                        echo $cityError;
                                    } ?></label>
                                <input type="text" name="city" class="form-control" id="city"
                                       value="<?php echo $rows['city'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="country">Country:</label>
                                <label for="country"><?php if (isset($countryError)) {
                                        echo $countryError;
                                    } ?></label>
                                <input type="text" name="country" value="<?php echo $rows['country'] ?>" id="country"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="accesslevel">Access Level: (Enter either 1 or 2)</label>
                                <label for="accesslevel"><?php if (isset($accesslevelError)) {
                                        echo $accesslevelError;
                                    } ?></label>
                                <input type="text" name="accesslevel" id="accesslevel"
                                       value="<?php echo $rows['accesslevel'] ?>"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Update">
                                <br>
                                <p class="text text-success"><?php if (isset($successMSG)) {
                                        echo $successMSG;
                                    } ?></p>
                                <br>
                                <p class="text text-danger"><?php if (isset($errorMSG)) {
                                        echo $errorMSG;
                                    } ?></p>
                            </div>
                        </form>
                        <h5>Access Level: If you want to make a user as admin, enter 1 otherwise 2</h5>
                    </div>
                </div>
            </div>

            <?php
        }
    }
} else {

    ?>

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
                        <th>Address</th>
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
                                <td><a href="user.php?id=<?php echo $rows['id']; ?>"><?php echo $rows['id']; ?></a></td>
                                <td><?php echo $rows['fullname'] ?></td>
                                <td><a href="mailto:<?php echo $rows['email'] ?>"><?php echo $rows['email'] ?></a></td>
                                <td><a href="tel:<?php echo $rows['telnr'] ?>"><?php echo $rows['telnr'] ?></a></td>
                                <td><?php echo $rows['address'] . "<br> " . $rows['address2'] ?></td>
                                <td><?php echo $rows['city'] ?></td>
                                <td><?php echo $rows['zip'] ?></td>
                                <td><?php echo $rows['country'] ?></td>
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

<?php }
include 'footer.php' ?>