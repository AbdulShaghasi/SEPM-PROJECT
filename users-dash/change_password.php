<?php
    session_start();
    include('../inc/header.inc');
    include('nav.inc');

    if(isset($_POST['newpass'])){
        $username = $_SESSION['user'];
        $newpass = $_POST['newpass'];
        
        #connect to db
        $db = mysqli_connect("127.0.0.1", "root","password", "SEPM")  or die(mysqli_error($db));

        #update password
        $newpassword = "UPDATE users SET password=SHA('$newpass') WHERE username='$username'";

        #run the query
        $changepass = mysqli_query($db, $newpassword) or die(mysqli_error($db));

        header("Location:main.php");
        exit(0);
    }
?>
<div class="center">
     <div class = "container login-container">
         <h2 style="position:center"> Change Password </h2>
             <form method="post" action="">
                <div class = "form-group">
                     <label for="newpassword">Enter New Password:</label>
                     <input type="text" class="form-control" placeholder="Enter New Password" name="newpass" required>
                </div>
                <button type="submit" class="btn btn-info">Change Password</button>
             </form><br>
         </div>
</div>


<?php
    include('../inc/footer.inc');
?>