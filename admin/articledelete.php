<?php 
include '../function/functions.php';
if (isset($_GET['id'])) {
    $articleID = test_input($_GET['id']);
    $sql = "DELETE FROM article WHERE id='$articleID'";
    if ($conn->query($sql) === true) {
        header("Location: index.php");
    }
}
?>