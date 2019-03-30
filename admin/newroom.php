<?php include 'header.php';
$name = $number = $article = $price = "";
$nameError = $numberError = $articleError = $priceError = "";
$error = false;
$successMSG = $errorMSG = "";
if (isset($_POST['submit'])) {
    /**
     * Secure the inputs
     */
    $name = test_input($_POST['name']);
    $number = test_input($_POST['number']);
    $article = test_input($_POST['article']);
    $price = test_input($_POST['price']);

    if ($error === false) {
        $sql = "INSERT INTO room(name, number, availability, image, article, price)"
            . "VALUES ('$name', '$number', '$number', 'img/single-bed.jpg', '$article', '$price')";
        if ($conn->query($sql)) {
            $successMSG = "The room has been added successfully.";
        } else {
            $errorMSG = "There was some error while submitting the new room" . $conn->error;
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
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="number">Number:</label>
                                <input type="text" class="form-control" name="number" id="number">
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
