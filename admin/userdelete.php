<?php
include '../function/functions.php';
if (isset($_GET['id'])) {
    $userID = test_input($_GET['id']);
    $sql = "DELETE FROM user WHERE id='$userID'";
    if ($conn->query($sql) === true) {
        header("Location: index.php");
    }
}
?>