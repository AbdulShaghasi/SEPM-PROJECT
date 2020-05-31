<?php
    session_start();
    include('/Library/WebServer/Documents/inc/header.inc');
    include('../nav.inc');

    # get details of the provided username
    if(isset($_POST['searchusername'])) $uname = $_POST['searchusername'];

    #connect to db
    $db = mysqli_connect("127.0.0.1", "root","password", "SEPM")  or die(mysqli_error($db));

    # connect to the database
    if(isset($uname)){
        $q = "SELECT * from users where username='$uname'";
        $results = mysqli_query($db, $q) or die(mysqli_error($db));

        if(mysqli_num_rows($results) > 0){
            while($row = mysqli_fetch_array($results)) {
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
                $address = $row["address"];
                $email = $row["email"];
                $contact_num = $row["contact_num"];
                $_SESSION['user'] = $row["username"]; #set this for change password
                $username = $_SESSION['user'];
                $password = $row["password"];
                $account_type = $row["account_type"];
                $expiry_date = $row["expiry_date"];
            }
        }
    }

    #update the user details
    if(isset($_POST['username'])){
        # set variables to for update
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $username = $_SESSION['user'];
        $contact_num=$_POST['contact_num'];
        
        
        # update the database
        $newdetails = "UPDATE users SET 
                                        firstname='$firstname',
                                        lastname='$lastname',
                                        address='$address',
                                        email='$email',
                                        contact_num='$contact_num' WHERE username='$username'";
        $applynewdetails = mysqli_query($db, $newdetails) or die(mysqli_error($db));
    }
?>

<!-- search user by username -->
<div class="center">
     <div class = "container login-container">
         <h2 style="position:center"> Search User</h2>
             <form method="post" action="">
                 <div class="form-group">
                     <label for="searchusername">Username:</label>
                     <input type="text" class="form-control" placeholder="Username" name="searchusername" required>
                 </div>
                 <button type="submit" class="btn btn-info">Search</button>
             </form><br>
         </div>
</div>
<!-- start of main content -->
<div class="center">
     <div class = "container login-container">
         <h2 style="position:center"> User Details</h2>
             <form method="post" action="">
                <div class = "form-group">
                     <label for="firstname">Username:</label>
                     <input type="text" class="form-control" readonly="readonly" name="username" required value="<?php if(isset($username)) echo $username; ?>">
                </div>
                <div class = "form-group">
                     <label for="firstname">First Name:</label>
                     <input type="text" class="form-control" placeholder="Enter First Name" name="firstname" required value="<?php if(isset($firstname)) echo $firstname; ?>">
                </div>
                <div class = "form-group">
                     <label for="lastname">Last Name:</label>
                     <input type="text" class="form-control" placeholder="Enter lastname" name="lastname" required value="<?php if(isset($lastname)) echo $lastname; ?>">
                </div>
                <div class = "form-group">
                     <label for="address">Address:</label>
                     <input type="text" class="form-control" placeholder="Enter address" name="address" required value="<?php if(isset($address)) echo $address; ?>">
                </div>
                <div class = "form-group">
                     <label for="email">Email:</label>
                     <input type="email" class="form-control" placeholder="Enter email" name="email" required value="<?php if(isset($email)) echo $email; ?>">
                </div>
                <div class = "form-group">
                     <label for="contact_num">Contact Number:</label>
                     <input type="text" class="form-control" placeholder="Enter contact_number" name="contact_num" required value="<?php if(isset($contact_num)) echo $contact_num; ?>">
                </div>
                
                <button type="submit" class="btn btn-info">Update Details</button>
                <a href="Change_username.php" class="btn btn-info" role="button">Change Username</a>
             </form><br>
         </div>
</div>

  <!-- end of main content -->
<?php
     include('/Library/WebServer/Documents/inc/footer.inc');
?>