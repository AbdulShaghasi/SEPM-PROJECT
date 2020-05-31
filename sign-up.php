<?php
    include("inc/header.inc");
    include("inc/nav.inc");
?>

<?php
session_start();

if(isset($_POST['firstname'])){
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $contact_num = $_POST['contact_num'];
  $password = $_POST['password'];
  $today = date("Y-m-d");
  $expire = date('Y-m-d', strtotime($today. ' + 3 month'));

  $db = mysqli_connect("127.0.0.1", "root","password", "SEPM")  or die(mysqli_error($db));
  $q = "INSERT INTO users (firstname, lastname, address, email, contact_num, username, password, account_type, reg_date, expiry_date)
  VALUES ('$firstname','$lastname','$address','$email',$contact_num,'$email',SHA('$password'),'customer','$today','$expire')";

  $results = mysqli_query($db, $q) or die(mysqli_error($db));

  $success = "Successfully added User!";

}

if (isset($success) == true){
    echo "<div class=\"alert alert-success alert-dismissible fade in\">";
    echo "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
    echo "<strong>Success!</strong> Account Successfully created. click <a href=\"login.php\" >here</a> to login.";
    echo "</div>";
}
?>
<!-- (firstname, lastname, address, email, contact_num, username, password, account_type, reg_date, expiry_date) -->

<!-- start of main content -->
 <div class="center">
     <div class = "container login-container">
         <h2 style="position:center">Register</h2>
             <form method="post" action="">
                 <div class = "form-group">
                     <label for="firstname">First Name:</label>
                     <input type="text" class="form-control" placeholder="Enter First Name" name="firstname" required>
                 </div>
                 <div class = "form-group">
                     <label for="lastname">Last Name:</label>
                     <input type="text" class="form-control" placeholder="Enter lastname" name="lastname" required>
                 </div>
                 <div class = "form-group">
                     <label for="address">Address:</label>
                     <input type="text" class="form-control" placeholder="Enter address" name="address" required>
                 </div>
                 <div class = "form-group">
                     <label for="email">Email:</label>
                     <input type="email" class="form-control" placeholder="Enter email" name="email" required>
                 </div>
                 <div class = "form-group">
                     <label for="contact_num">Contact Number:</label>
                     <input type="text" class="form-control" placeholder="Enter contact_number" name="contact_num" required>
                 </div>
                 <div class="form-group">
                     <label for="password">Password:</label>
                     <input type="password" class="form-control" placeholder="Enter password" name="password" required>
                 </div>
                 <button type="submit" class="btn btn-info">Register</button>
             </form><br>
         </div>
 </div>

  <!-- end of main content -->

<?php
    include("inc/footer.inc");
?>
