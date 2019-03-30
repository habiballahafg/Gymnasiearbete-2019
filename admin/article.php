<?php
include 'header.php';
/*  Code to update article goes here **/
$title = $post = "";
$titleError = $postError = "";
$error = false;
$successMSG = $errorMSG = "";
$articleID = "";
if (isset($_GET['id'])) {
    $articleID = test_input($_GET['id']);
}
if (isset($_POST['update-article'])) {

    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadError = "";
    /* Check out the title  */
    if (isset($_POST['title'])) {
        $title = test_input($_POST['title']);
        if (empty($title)) {
            $error = true;
            $titleError = "The title field is required.";
        }
    }

    /* Check out the post */
    if (isset($_POST['post'])) {
        $post = test_input($_POST['post']);
        if (empty($post)) {
            $error = true;
            $postError = "The Post field is required.";
        }
    }

    /* Update the Database Query if $error is FALSE */
// Check if file already exists
    if (file_exists($target_file)) {
        $uploadError = "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $uploadError = "Sorry, your file is too large.";
        $error = true;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $uploadError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $error = true;
    }
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $target_file = "img/" . basename($_FILES["fileToUpload"]["name"]);
        if ($error === false) {
            $articleID = $_POST['id'];
            $time = date('Y-m-d');
            $sql = "UPDATE article SET title='$title', img = '$target_file', post='$post', articledate= '$time' WHERE id='$articleID'";
            if ($conn->query($sql) === true) {
                $successMSG = "The article has been updated successfully.";

            } else {
                $errorMSG = "The article could not be updated, please try again later.";
            }
        }
    }
} //end updating article

if (isset($_POST['publish'])) {
    $title = $post = "";
    $titleError = $postError = "";
    $error = false;
    $successMSG = $errorMSG = "";
    $time = "";
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES["imegeUpload"]["name"]);

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadError = "";
    if (isset($_POST['title'])) {
        $title = test_input($_POST['title']);
        if (empty($title)) {
            // check the title input if it is empty]
            $error = true;
            $titleError = "The title field is required.";
        }

    } // end checking the title
    if (isset($_POST['post'])) {
        $post = test_input($_POST['post']);
        if (empty($post)) {
            $error = true;
            $postError = "The post field is required.";
        }
    } // end checking the post
// Check if file already exists
    if (file_exists($target_file)) {
        $uploadError = "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["imegeUpload"]["size"] > 500000) {
        $uploadError = "Sorry, your file is too large.";
        $error = true;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $uploadError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $error = true;
    }
    if (move_uploaded_file($_FILES["imegeUpload"]["tmp_name"], $target_file)) {
        $target_file = "img/" . basename($_FILES["imegeUpload"]["name"]);
        if ($error === false) {
            $time = date('Y-m-d');
            $sql = "INSERT INTO article(title,img, post, articledate) VALUES ('$title', '$target_file', '$post', '$time')";
            if ($conn->query($sql) === true) {
                $successMSG = "The post has been published successfully.";
            } // end successMSG
            else {
                $errorMSG = "There was a problem, please try again.";
            }
        }
    }

} // end publishing new article


if (isset($_SESSION['currentID'])) {
    $userID = $_SESSION['currentID'];
    $sql = "SELECT accesslevel FROM user WHERE id='$userID'";
    $result = $conn->query($sql);
    if ($result->num_rows != 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['accesslevel'] != 2) {
                header("Location: login.php");
            }
        }
    }
} else {
    header("Location: login.php");
}
?>

<div class="container-fluid">
    <div class="row bg-white">
        <div class="col-lg-10 align-center">
            <?php
            if (isset($_GET['id'])) {
                $articleID = $_GET['id'];
                $sql = "SELECT * FROM article WHERE id='$articleID'";
                $result = $conn->query($sql);
                if ($result->num_rows != 0) {
                    /** HEre we will edit an article */
                    while ($rows = $result->fetch_assoc()) {
                        ?>

                        <h1 class="title">Edit Article <?php echo $rows['title'] ?></h1>
                        <form method="post" action="article.php" enctype="multipart/form-data" class="form-group">
                            <div class="form-group">
                                <label for="id">ID:</label>
                                <input type="text" name="id" id="id" value="<?php echo $articleID ?>">
                            </div>
                            <div class="form-group row">
                                <label class="mx-2" for="title">Title: </label>
                                <input type="text" class="mx-2 form-control" name="title"
                                       value="<?php echo $rows['title'] ?>"
                                       id="title">
                            </div>
                            <div class="form-group">
                                <textarea name="post" id="mytextarea"><?php echo $rows['post'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="fileToUpload">Image</label>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="update-article" value="Publish" class="btn btn-primary">
                            </div>
                        </form>

                        <?php
                    }
                } else {
                    /** Here we will output an error, the article u r looking for does not exist. Check out the id again */
                    echo "The Article you are looking for does not exist or the id for article is wrong, please try again.";
                }
            } else {
                /** Here user will be able to post new article inside the explore Stockholm, */
                ?>

                <h1>New Article</h1>

                <form method="post" action="article.php" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label class="col-sm=2 mx-2" for="title">Title</label>
                        <input type="text" class="mx-2 form-control col-sm-9" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label class="text text-danger" for="mytextarea"><?php echo $postError ?></label>
                        <textarea id="mytextarea" class="form-control" name="post">Hello, World!</textarea>
                    </div>
                    <div class="form-group">
                        <label for="imageUpload">Upload: </label>
                        <input type="file" name="imegeUpload" class="form-control" id="imageUpload">
                    </div>
                    <div class="form-group">
                        <label class="text text-success"><?php echo $successMSG ?></label>
                        <label class="text text-danger"><?php echo $errorMSG ?></label>
                        <br>
                        <input type="submit" name="publish" value="Publish" class="btn btn-primary">
                    </div>
                </form>

                <?php

            }
            ?>
        </div>
    </div>
    <?php include 'footer.php' ?>



