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

    if ($error === false) {
        $time = date('Y-m-d');
        $sql = "UPDATE article SET title='$title', post='$post', articledate= '$time' WHERE id='$articleID'";
        if ($conn->query($sql) === true) {
            $successMSG = "The article has been updated successfully.";

        } else {
            $errorMSG = "The article could not be updated, please try again later.";
        }
    }
} //end updating article

if (isset($_POST['publish'])) {
    $title = $post = "";
    $titleError = $postError = "";
    $error = false;
    $successMSG = $errorMSG = "";
    $time = "";
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

    if ($error === false) {
        $time = date('Y-m-d');
        $sql = "INSERT INTO article(title, post, articledate) VALUES ('$title', '$post', '$time')";
        if ($conn->query($sql) === true) {
            $successMSG = "The post has been published successfully.";
        } // end successMSG
        else {
            $errorMSG = "There was a problem, please try again.";
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

                        <h1>Edit Article <?php echo $rows['title'] ?></h1>
                        <form method="post" action="article.php" class="form-group">
                            <label class="col-form-label" for="title">Title: </label>
                            <input type="text" class="form-control-sm" name="title" value="<?php echo $rows['title'] ?>"
                                   id="title" placeholder="title">
                            <br>
                            <textarea name="post" id="mytextarea"><?php echo $rows['post'] ?></textarea>
                            <br>
                            <input type="submit" name="update-article" value="Publish" class="btn btn-primary">
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
                <form method="post" action="article.php" class="form-group">
                    <label class="label ">Title</label>
                    <input type="text" class="form-control-sm" name="title">
                    <br>
                    <label class="text text-danger" for="mytextarea"><?php echo $postError ?></label>
                    <textarea id="mytextarea" class="form-control" name="post">Hello, World!</textarea>
                    <br>
                    <label class="text text-success"><?php echo $successMSG ?></label>
                    <label class="text text-danger"><?php echo $errorMSG ?></label>
                    <input type="submit" name="publish" value="Publish" class="btn btn-primary">
                </form>

                <?php

            }
            ?>
        </div>
    </div>
    <?php include 'footer.php' ?>



