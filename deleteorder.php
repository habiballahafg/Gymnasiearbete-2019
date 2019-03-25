<?php
/**
 * Created by PhpStorm.
 * User: hezar
 * Date: 2019-03-25
 * Time: 13:45
 */
include  'function/functions.php';
    if (isset($_GET['id'])) {
        $orderID = test_input($_GET['id']);
        $sql = "DELETE FROM guest WHERE id='$orderID'";
        if ($conn->query($sql) === true) {
            header("Location: profile.php");
        }
    }
