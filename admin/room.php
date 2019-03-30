<?php include 'header.php';
if (isset($_GET['id'])) {
    $roomDescriptionError = $roomImageAddressError = $roomNumberError = $roomTypeError = "";
    $roomID = test_input($_GET['id']);
    $sql = "SELECT * FROM room WHERE id ='$roomID'";
    $result = $conn->query($sql);
    if ($result->num_rows != 0) {
        while ($rows = $result->fetch_assoc()) {
            /**
             * Here we need to make the info about the room editable
             */
            if (isset($_POST['update'])) {
                $roomName = $roomNumber = $roomImageAddress = $roomAvailable = $roomDescription = $roomPrice = "";
                $roomNameError = $roomNumberError = $roomAvailableError = $roomDescriptionError = $roomPriceError = "";
                $error = false;
                $successMSG = $errorMSG = "";

                /**
                 * Secure the input
                 */

                $roomName = test_input($_POST['name']);
                $roomNumber = test_input($_POST['number']);
                $roomImageAddress = test_input($_POST['image']);
                $roomDescription = test_input($_POST['description']);
                $roomPrice = test_input($_POST['price']);

                /**
                 *  Update the query
                 */

                $roomUpdateSQL = "UPDATE room
SET name= '$roomName', number = '$roomNumber', image = '$roomImageAddress', article = '$roomDescription', price = '$roomPrice'
WHERE id='$roomID'";
                if ($conn->query($roomUpdateSQL) === true) {
                    $successMSG = "The record has been update successfully.";
                } else {
                    $errorMSG = "There has been some problem, pleas try again later" . $conn->error;
                }
            } ?>
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <h3><a href="newroom.php" target="_blank">Click here if you want to make a new room</a></h3>
                                <div>
                                    <h3>Edit Room</h3>
                                    <table class="table">
                                        <tbody>
                                        <form method="post" class="form-group">
                                            <tr>
                                                <th>The room type</th>
                                                <th><input type="text" class="form-control" name="name"
                                                           value="<?php echo $rows['name'] ?>"></th>
                                            </tr>
                                            <tr>
                                                <th>Total number of this type</th>
                                                <th><input type="text" class="form-control" name="number"
                                                           value="<?php echo $rows['number'] ?>"</th>
                                            </tr>
                                            <tr>
                                                <th>Image Address</th>
                                                <th><input type="text" class="form-control" name="image"
                                                           value="<?php echo $rows['image'] ?>"></th>
                                            </tr>
                                            <tr>
                                                <th>Room Description</th>
                                                <th><textarea name="description" id="descriotion" class="form-control" cols="100"
                                                              rows="10"><?php echo $rows['article'] ?></textarea></th>
                                            </tr>
                                            <tr>
                                                <th>Price</th>
                                                <th><input type="text" class="form-control" name="price"
                                                           value="<?php echo $rows['price'] ?>"></th>
                                            </tr>
                                            <tr>
                                                <th><input type="submit" class="btn btn-primary" value="UPDATE"
                                                           name="update"></th>
                                            </tr>
                                        </form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        /**
         * The ID is wrong, output here ->
         */
        echo "<h2>The room you are looking for is not exist, check out the id again</h2>";
    }
} else {
    /**
     * Here we will list out the all rooms, and adding new rooms.
     */ ?>
    <div class="card">
        <div class="card-title">
            <h2>Rooms: </h2>
        </div>
        <div class="card-body">
            <table div class="table">
                <thead>
                <tr>
                    <th>Room ID</th>
                    <th>Room Type</th>
                    <th>Total number of Room</th>
                    <th>Available rooms</th>
                    <th>Busy rooms</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>price</th>
                    <th>Functions</th>
                </tr>
                </thead>
                <tbody>

                <h3><a href="newroom.php" target="_blank">Click here if you want to make a new room</a></h3>
                <?php
                $roomSQL = "SELECT * FROM room";
    $roomResult = $conn->query($roomSQL);
    if ($roomResult->num_rows != 0) {
        while ($roomRows = $roomResult->fetch_assoc()) {
            ?>
                        <tr>
                            <td><?php echo $roomRows['id'] ?></td>
                            <td><?php echo $roomRows['name'] ?></td>
                            <td><?php echo $roomRows['number'] ?></td>
                            <td><?php echo $roomRows['availability'] ?></td>
                            <td><?php
                                $totalRoom = intval($roomRows['number']);
            $availableRoom = intval($roomRows['availability']);
            echo $totalRoom - $availableRoom; ?></td>
                            <td><img width="150px" height="100px" src="../<?php echo $roomRows['image'] ?>"
                                     alt="<?php echo $roomRows['name'] ?>"></td>
                            <td><?php substr($roomRows['article'], 0, 100) ?></td>
                            <td>$<?php echo $roomRows['price'] ?> USD</td>
                            <td><a class="my-2 btn btn-danger text-white" href="roomdelete.php?id=<?php echo $roomRows['id'] ?>">Delete Room</a>
                            <a href="room.php?id=<?php echo $roomRows['id'] ?>" class="btn btn-primary text-white">Edit Room</a></td>
                        </tr>
                        <?php
        }
    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}
include 'footer.php'; ?>
