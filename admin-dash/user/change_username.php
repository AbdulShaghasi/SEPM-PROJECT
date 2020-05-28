<?php
    session_start();
    include('/Library/WebServer/Documents/inc/header.inc');
    include('../nav.inc');

    if(isset($_POST['newusername'])){
        $username = $_SESSION['user'];
        $newusername = $_POST['newusername'];
        $newtype = $_POST['account_type'];
        
        #connect to db
        $db = mysqli_connect("127.0.0.1", "root","password", "SEPM")  or die(mysqli_error($db));

        #update password
        $newusername = "UPDATE users SET username='$newusername' WHERE username='$username'";

        #run the query
        $changeusername = mysqli_query($db, $newusername) or die(mysqli_error($db));

        #update account type
        $account_type = $_POST['account_type'];
        $newaccounttype = "UPDATE users SET account_type='$newtype' WHERE username='$username'";

        #run the query
        $changeaccounttype = mysqli_query($db, $newaccounttype) or die(mysqli_error($db));

        header("Location:user-dash.php");
        exit(0);
    }
?>
<div class="center">
     <div class = "container login-container">
         <h2 style="position:center"> Change Password </h2>
             <form method="post" action="">
                <div class = "form-group">
                     <label for="newpassword">New Username</label>
                     <input type="text" class="form-control" placeholder="Enter New Password" name="newusername" required>
                </div>
                <div class = "form-group">
                      <label for="account_type">Choose account type:</label>
                          <select id="Account_Type" name="account_type" required>
                            <option disabled selected value> -- select an option -- </option>
                            <option value="admin">Admin</option>
                            <option value="assistant">Assistant</option>
                            <option value="user">Normal User</option>
                          </select>
                </div>
                <button type="submit" class="btn btn-info">Change Password</button>
             </form><br>
         </div>
</div>


<?php
    include('../../inc/footer.inc');
?>