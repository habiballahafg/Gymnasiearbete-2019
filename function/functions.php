<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gyar";
$conn = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_errno) {

    print_r($conn->connect_error);

}
/**
 * The test_input()  function will check out every user inputs to securize them from any type of hacking as well as attacking:
 * This function get 1 argument $data and then we put it through 3 different functions
 */

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


/**
 * Define a function to redirect to a link we will refer it,
 */
function redirectLink ($link, $sessionName, $Message){
    header("Location: " . $link);
    if (isset($sessionName) && isset($Message)) {
        $_SESSION[$sessionName] = $Message;
    }
}

/**
 * Make a random number to build the order number for users who book a room:
 * Here we have a order number which is 6 characters long and include both numbers and letter
 * We return the order number [booking.php]
 * obs the order number is not case sensitive
 */

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * Get the title from databse and print it out on web page
 */

function getTitle () {
    $titleSQL = "SELECT title FROM generalsettings";
    $titleResult  = $conn->query($titleSQL);

    if ($titleResult->num_rows != 0) {
        while ($rows = $titleResult->fetch_assoc()){
           $title =  $rows['title'];
           echo $title;
        }
    }

}

?>