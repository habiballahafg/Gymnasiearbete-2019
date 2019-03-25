<?php include 'header.php';

$siteTitle = $language = $facebook = $instagram = $youtube = $address = $telnr = "";
$siteTitleError = $languageError = $facebookError = $instagramError = $youtubeError = $addressError = $telnrError = "";
$successMSG = $errorMSG = "";
$error = false;
if (isset($_POST['submit'])) {
    $siteTitle = test_input($_POST['site-title']);
    $language = test_input($_POST['language']);
    $facebook = test_input($_POST['facebook']);
    $instagram = test_input($_POST['instagram']);
    $youtube = test_input($_POST['youtube']);
    $address = test_input($_POST['address']);
    $telnr = test_input($_POST['telnr']);

    /**
     * check out the site title input
     */


    if ($error === false) {
        $sql = "UPDATE generalsettings SET title = '$siteTitle', language = '$language', facebook = '$facebook', instagram = '$instagram', youtube= '$youtube', 
 address = '$address', telnr = '$telnr' WHERE id= 1";
        if ($conn->query($sql) === true) {
            $successMSG = "The settings have been updated successfully.";
        } else {
            $errorMSG = "There was an error while updating the settings, please try again later. The error is: " . $conn->error;
        }
    }
}


$sql = "SELECT * FROM generalsettings";
$result = $conn->query($sql);
if ($result->num_rows != 0) {
    while ($rows = $result->fetch_assoc()) {
        ?>
        <div class="container-fluid bg-white">
            <main>
                <h1>Settings</h1>
                <table class="table">
                    <thead>
                    <form action="settings.php" method="post" class="form-group">
                        <tr>
                            <td>Site title:</td>
                            <td><input class="form-control-sm" type="text" name="site-title"
                                       value="<?php echo $rows['title'] ?>"></td>
                        <tr>
                            <td>Language:</td>
                            <td><input class="form-control-sm" type="text" name="language"
                                       value="<?php echo $rows['language'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Facebook Link:</td>
                            <td><input type="text" class="form-control-sm" name="facebook"
                                       value="<?php echo $rows['facebook'] ?>"</td>
                            <td>Instagram Link:</td>
                            <td><input type="text" name="instagram" class="form-control-sm"
                                       value="<?php echo $rows['instagram'] ?>"</td>
                            <td>Youtube Link</td>
                            <td><input type="text" name="youtube" class="form-control-sm"
                                       value="<?php echo $rows['youtube'] ?>"</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><input type="text" name="address" class="form-control-sm"
                                       value="<?php echo $rows['address'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Telehpne Number:</td>
                            <td><input type="text" name="telnr" class="form-control-sm"
                                       value="<?php echo $rows['telnr'] ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <input class="btn btn-primary" type="submit" name="submit" value="Update">
                                <br>

                                <?php if (isset($successMSG)) {
                                    echo '<p class="text-success">' . $successMSG . '</p>';
                                } else if (isset($errorMSG)) {
                                    echo '<p class="text-danger">' . $errorMSG . '</p>';
                                } ?>
                            </td>
                        </tr>
                    </
                    @form>
                    </thead>
                </table>
            </main>
        </div>
        <?php
    }
}
?>

<?php include 'footer.php' ?>