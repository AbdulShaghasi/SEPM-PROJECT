<?php
session_start();
include("inc/header.inc");
include("inc/nav.inc");

$today = date("Y-m-d H:i:s");

// process login user based on username
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = mysqli_connect("127.0.0.1", "root", "password", "SEPM")  or die(mysqli_error($db));
    $q = "select * from users where username='$username' and password=SHA('$password')";
    $results = mysqli_query($db, $q) or die(mysqli_error($db));

    if (mysqli_num_rows($results) > 0) {

        $_SESSION['username'] = $username;

        while($row = mysqli_fetch_array($results)) {
            $type = $row["account_type"];
            $_SESSION["last_login"] = $row["last_login"];
            $_SESSION['userID'] = $row[0];
            //sets last login time
            $q = "UPDATE users SET last_login = '$today' WHERE username='$username'";
            mysqli_query($db, $q) or die(mysqli_error($db));

            if ($type == "admin") {
                header("Location:admin-dash/main.php");
                exit(0);
            } else if ($type == "assistant") {
                header("Location:assistant-dash/main.php");
                exit(0);
            } else if ($type == "customer") {
                header("Location:users-dash/main.php");
                exit(0);
            } else if ($type == "Deactivate") {
                echo "User account Deactivated, Please contact an admin.";
            }
        }
        //nav bar

    } else {
        unset($_POST['username']);
        unset($_POST['password']);
        //nav bar


        echo "<div class=\"alert alert-danger alert-dismissible fade in\">";
        echo "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
        echo "<strong>Failed!</strong> Username or password is incorrect. New to the site? Click <a href='sign-up.php'>here</a> to sign up.";
        echo "</div>";
    }
}
?>


<!-- start of main content -->
<div class="center">
    <div class="container login-container">
        <h2 style="position:center">Login</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" placeholder="Enter username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" placeholder="Enter password" name="password" required>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="remember"> Remember me</label>
            </div>
            <button type="submit" class="btn btn-info">Login</button>
        </form><br>
    </div>
</div>


<!-- end of main content -->

<?php
include("inc/footer.inc");
?>
