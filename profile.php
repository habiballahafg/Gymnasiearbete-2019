<?php
include_once 'header.php';
if (isset($_SESSION['currentID'])) {
    /**
     * I create the profile page here if the user is logged in so he/she will have access
     * otherwise the user must be redirected to login page.
     */
    $fullName = $fullNameError = $successMSG = $errorMSG = "";
    $error = false;
    if (isset($_POST['fullname'])) {
        $fullName = test_input($_POST['fullname']);
        if (!empty($fullName)) {
            if (strlen($fullName) < 3) {
                $error = true;
                $fullNameError = "The full name field cannot be less than 3 characters";
            }
            if (!preg_match("/^[a-zA-Z ]*$/", $fullName)){
                $error = true;
                $fullNameError = "The name field can only include letters.";
            }
        } else {
            $error = true;
            $fullNameError = "Please fill in the name field.";
        }
        if ($error == false) {
            $fullNameSQL = "UPDATE user SET fullname ='$fullName' WHERE id='$userID'";
            if ($conn->query($fullNameSQL) === true) {
                $successMSG =  "The name has been updated successfully.";
            } else {
                $errorMSG = "there was a problem by updating the name, please try again later or contact us";
            }
        }
    }

    ?>
    <div class="row">
        <div class="col-4">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                   href="#list-home" role="tab" aria-controls="home">Profile</a>
                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                   href="#list-profile" role="tab" aria-controls="profile">Bookings</a>
                <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list"
                   href="#list-messages" role="tab" aria-controls="messages">Settings</a>
            </div>
        </div>
        <div class="col-8 profile-card">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="img-profile/profile.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                    <div class="jumbotron">
                        <div class="row">
                            <div class="col-3">
                                <img class="img-fluid" src="img/single-bed-1.jpg">
                            </div>
                            <div class="col-9">
                                <h1>Single bedroom</h1>
                                <ul>
                                    <li>Check In: 2019-05-04</li>
                                    <li>Check Out: 2019-05-10</li>
                                    <li>Order number: 29476</li>
                                </ul>
                                <p>Remember that the check in time is betwenn 12-16.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade float-left col-8" id="list-messages" role="tabpanel"
                     aria-labelledby="list-messages-list">
                    3...
                    <h2>Update your settings</h2>
                    <table class="table">
                        <tbody>
                        <tr id="table-edit">
                            <?php
                            $userID = $_SESSION['currentID'];
                            $sql = "SELECT * FROM user WHERE id= '$userID'";
                            $result = $conn->query($sql);
                            if ($result->num_rows != 0){
                            while ($rows = $result->fetch_assoc()){
                            ?>
                            <th scope="row">Your name</th>
                            <td><input type="text" class=" form-control-sm" name="fullname"
                                       value="<?php echo $rows['fullname'] ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                            <td class="text text-danger"><?php echo $fullNameError ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Your e-mail address</th>
                            <td><input type="email" class="form-control-sm" value="<?php echo $rows['email']; ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                        </tr>
                        <tr>
                            <th scope="row">Your telephone number</th>
                            <td><input type="text" name="telnr" class="form-control-sm" value="<?php echo $rows['telnr']; ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                            <td><input type="text" name="address" class="form-control-sm" value="<?php echo $rows['address']; ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                        </tr>
                        <tr>
                            <th scope="row">Your optional address</th>
                            <td><input type="text" name="address2" class="form-control-sm" value="<?php echo $rows['address2']; ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                        </tr>
                        <tr>
                            <th scope="row">City</th>
                            <td><input type="text" name="telnr" class="form-control-sm" value="<?php echo $rows['city']; ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                        </tr>
                        <tr>
                            <th scope="row">Zip</th>
                            <td><input type="text" name="telnr" class="form-control-sm" value="<?php echo $rows['zip']; ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
                        </tr>
                        <tr>
                            <th scope="row">Your telephone number</th>
                            <td><input type="text" name="telnr" class="form-control-sm" value="<?php echo $rows['telnr']; ?>"></td>
                            <td><img src="img/edit.svg" class="img-icon edit-icon" alt="Edit your name">
                                <img src="img/confirm.png" class="img-icon confirm-icon" alt="Confirm"></td>
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
    </div>
    <?php
} else {
    header("Location: login.php");
}
?>
<script language="JavaScript">
    const editIcon = document.querySelector('.edit-icon');
    const confirmIcon = document.querySelector('.confirm-icon');
    const tableEdit = document.getElementById('table-edit');

    editIcon.addEventListener('click', () => {
        editIcon.style.display = 'none';
        confirmIcon.style.display = 'inline';
    });// end addEventListener

    confirmIcon.addEventListener('click', () => {
        confirmIcon.style.display = "none";
        editIcon.style.display = "inline";
    }); // end addEventListener


</script>


<?php
include_once 'footer.php';
?>
