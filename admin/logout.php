<?php 
session_start();
if (isset($_SESSION['currentID'])) {
    unset($_SESSION['currentID']);
    header("Location: login.php");
}
else {
    echo "You are not allowed to have access this page.";
}
?>