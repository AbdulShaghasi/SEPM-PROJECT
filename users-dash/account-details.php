<?php
session_start();
include('../inc/header.inc');
include('nav.inc');

#connect to db
$db = mysqli_connect("127.0.0.1", "root", "password", "SEPM")  or die(mysqli_error($db));

$uname = $_SESSION['username'];

# connect to the database
if (isset($uname)) {
     $q = "SELECT * from users where username='$uname'";
     $results = mysqli_query($db, $q) or die(mysqli_error($db));

     if (mysqli_num_rows($results) > 0) {
          while ($row = mysqli_fetch_array($results)) {
               $firstname = $row["firstname"];
               $lastname = $row["lastname"];
               $address = $row["address"];
               $email = $row["email"];
               $contact_num = $row["contact_num"];
               $_SESSION['user'] = $row["username"]; #set this for change password
               $username = $_SESSION['user'];
               $account_type = $row["account_type"];
               $expiry_date = $row["expiry_date"];
          }
     }
}

#update the user details
if (isset($_POST['confirm_pass'])) {
     # set variables to for update
     $firstname = $_POST['firstname'];
     $lastname = $_POST['lastname'];
     $address = $_POST['address'];
     $email = $_POST['email'];
     $contact_num = $_POST['contact_num'];
     $expiry_date = $_POST['expiry_date'];


     # update the database
     $newdetails = "UPDATE users SET 
                                        firstname='$firstname',
                                        lastname='$lastname',
                                        address='$address',
                                        email='$email',
                                        contact_num='$contact_num',
                                        expiry_date='$expiry_date' WHERE username='$username'";
     $applynewdetails = mysqli_query($db, $newdetails) or die(mysqli_error($db));

     $success = "Successfully added User!";

     if (isset($success) == true) {
          echo "<div class=\"alert alert-success alert-dismissible fade in\">";
          echo "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
          echo "<strong>Success!</strong> Account Details Successfully Updated.";
          echo "</div>";
     }
     header("Refresh:3");
}
?>
<!-- start of main content -->
<div class="center">
     <div class="container login-container">
          <h2 style="position:center"> User Details</h2>
          <form method="post" action="">
               <div class="form-group">
                    <label for="firstname">Username:</label>
                    <input type="text" class="form-control" readonly="readonly" name="username" required value="<?php echo $_SESSION['username'] ?>">
               </div>
               <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" class="form-control" placeholder="Enter First Name" name="firstname" required value="<?php echo $firstname; ?>">
               </div>
               <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" class="form-control" placeholder="Enter lastname" name="lastname" required value="<?php echo $lastname; ?>">
               </div>
               <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" placeholder="Enter address" name="address" required value="<?php echo $address; ?>">
               </div>
               <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email" required value="<?php echo $email; ?>">
               </div>
               <div class="form-group">
                    <label for="contact_num">Contact Number:</label>
                    <input type="text" class="form-control" placeholder="Enter contact_number" name="contact_num" required value="<?php echo $contact_num; ?>">
               </div>
               <div class="form-group">
                    <label for="expiry_date">Expiry Date:</label>
                    <input type="text" class="form-control" placeholder="E.g. Y-m-d" name="expiry_date" required value="<?php echo $expiry_date; ?>">
               </div>
               <div class="form-group">
                    <label for="confirm_pass">Confirm your password:</label>
                    <input type="password" class="form-control" placeholder="Confirm your password" name="confirm_pass" required value="">
               </div>
               <button type="submit" class="btn btn-info">Update Details</button>
               <a href="change_password.php" class="btn btn-info" role="button">Change Password</a>
          </form><br>
     </div>
</div>

<!-- end of main content -->
<?php
include('/Library/WebServer/Documents/inc/footer.inc');
?>