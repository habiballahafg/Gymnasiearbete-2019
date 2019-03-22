<?php
include '../function/functions.php';
if (isset($_GET['id'])) {
    $roomID = test_input($_GET['id']);
    $sql = "DELETE FROM room WHERE id='$roomID'";
    if ($conn->query($sql) === true) {
        header("Location: index.php");
    }
}
?>