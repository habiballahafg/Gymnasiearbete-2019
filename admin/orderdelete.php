<?php
include '../function/functions.php';
if (isset($_GET['id'])) {
    $orderID = test_input($_GET['id']);
    $sql = "DELETE FROM guest WHERE id='$orderID'";
    if ($conn->query($sql) === true) {
        header("Location: index.php");
    }
}
?>