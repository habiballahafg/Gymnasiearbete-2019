<?php include 'header.php';
$email = $password = "";
$emailError = $passwordError = "";
$error = false;
$rememberME = "";
if (isset($_POST['submit'])) {
    $password = test_input($_POST['user-password']);
    $email = test_input($_POST['user-email']);

    /**
     * check the password field
     */

    if (!empty($password)) {
        if (strlen($password) < 8){
            $error = true;
            $passwordError = "The password must be at least 8 characters.";
        }
    } else {
        $error = true;
        $passwordError = "The password field cannot be left empty.";
    }

    /**
     * check the email field
     */

    if (!empty($email)) {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $emailError = "The email address you've entered is not legal.";
        }
    } else {
        $error = true;
        $emailError = "The email field cannot be left empty";
    }

    /**
     * Send the sql query.
     */
    if ($error === false) {
        $password = md5($password);
        $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows != 0){
            while ($rows = $result->fetch_assoc()){
                $_SESSION['currentID'] = $rows['id'];
                header("Location: index.php");

            }
        }
    }
}
?>

<div class="container">
    <div class="row">
        <div class="control-group mx-auto">
            <h1>Login</h1>
            <form action="login.php" method="post">
                <label for="user-email" class="label-info">E-mail Address:</label>
                <label for="user-email" class="text text-danger"><?php echo $emailError ?></label>
                <input type="email" class="form-control" id="user-email" name="user-email">
                <label for="user-password" class="label-info">Password:</label>
                <label for="user-email" class="text text-danger"><?php echo $passwordError ?></label>
                <input type="password" id="user-password" name="user-password" class="form-control">
                <br>
                <input type="submit" class="btn btn-primary" name="submit" value="Log In">
            </form>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>
