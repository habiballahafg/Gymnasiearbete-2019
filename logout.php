<?php
session_start();
/**
 * Created by PhpStorm.
 * User: hezar
 * Date: 2019-03-14
 * Time: 12:38
 */
if (isset($_SESSION['currentID'])){
unset($_SESSION['currentID']);
header("Location: index.php");
}
?>