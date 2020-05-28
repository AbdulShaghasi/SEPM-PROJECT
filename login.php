<?php

// process login user based on username
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = mysqli_connect("127.0.0.1", "root","password", "SEPM")  or die(mysqli_error($db));
    $q = "select * from users where username='$username' and password=SHA('$password')";
    $results = mysqli_query($db, $q) or die(mysqli_error($db));

    if(mysqli_num_rows($results) > 0)
    {
        session_start();
        $_SESSION['username'] = $username;
        while($row = mysqli_fetch_array($results)) {
            $type = $row["account_type"];
            if($type == "admin"){
                header("Location:admin-dash/main.php");
                exit(0);
            }
            if($type == "assistant"){
                header("Location:assistant-dash/main.php");
                exit(0);
            }
            if($type == "customer"){
                header("Location:users-dash/main.php");
                exit(0);
            }
            if($type == "Deactivate"){
                echo "User account Deactivated, Please contact an admin.";
        }
      }
    }
    else{
        unset($_POST['username']);
        unset($_POST['password']);
        header("Location:main.php");
    }
}


//nav bar
    include("inc/header.inc");
    include("inc/nav.inc");

?>


<!-- start of main content -->
<div class="center">
    <div class = "container login-container">
        <h2 style="position:center">Login</h2>
            <form method="post" action="">
                <div class = "form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" placeholder="Enter username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" placeholder="Enter password" name="password">
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
