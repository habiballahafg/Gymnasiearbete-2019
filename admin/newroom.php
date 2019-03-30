<?php include 'header.php';
$name = $number = $article = $price = "";
$nameError = $numberError = $articleError = $priceError = "";
$error = false;
$successMSG = $errorMSG = "";

if (isset($_POST['submit'])) {
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadError = "";
    /**
     * Secure the inputs
     */
    $name = test_input($_POST['name']);
    $number = test_input($_POST['number']);
    $article = test_input($_POST['article']);
    $price = test_input($_POST['price']);


    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadError = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $uploadError = "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
    if (file_exists($target_file)) {
        $uploadError = "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $uploadError = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $uploadError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        if ($error === false) {
            $sql = "INSERT INTO room(name, number, availability, image, article, price)"
                . "VALUES ('$name', '$number', '$number', '$target_file', '$article', '$price')";
            if ($conn->query($sql)) {
                $successMSG = "The room has been added successfully.";
            } else {
                $errorMSG = "There was some error while submitting the new room" . $conn->error;
            }


        }
    }
}
?>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card col-md-12">
            <div class="card-body col-md-12">
                <div class=" align-items-center">
                    <div>
                        <form action="newroom.php" method="post">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <label for="name"><?php if (isset($nameError)) {
                                        echo $nameError;
                                    } ?></label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="number">Quantity:</label>
                                <label for="number"><?php if (isset($numberError)) {
                                        echo $numberError;
                                    } ?></label>
                                <input type="text" class="form-control" name="number" id="number">
                            </div>
                            <div class="form-group">
                                <label for="fileToUpload">Upload: </label>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                            <div class="form-group">
                                <label for="article">Article:</label>
                                <textarea name="article" id="article" cols="30" rows="10"
                                          class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" name="price" id="price">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                <label><?php if (isset($successMSG)) {
                                        echo $successMSG;
                                    } ?></label>
                                <label><?php if (isset($errorMSG)) {
                                        echo $errorMSG;
                                    } ?></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
