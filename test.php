<?php
include 'function/functions.php';

$sql = "SELECT * FROM guest";

$result = $conn->query($sql);

if ($result->num_rows != 0 ) {
    while ($rows = $result->fetch_assoc()) {
        $chekcinDate = $rows['checkin'];
        $todayDate = date("Y-m-d");
        echo $chekcinDate;
        echo "<br>";
        echo $todayDate ;
        echo "<br>";

        $differenceDate = strtotime($chekcinDate) - strtotime($todayDate);
        $differenceDate = $differenceDate / 84600;
        echo "Approximately about " . $differenceDate;
    }
}