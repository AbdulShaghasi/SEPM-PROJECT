<?php
    session_start();
    include("../inc/header.inc");
    include("nav.inc");
?>

<div class="container">
  <div class="jumbotron">
    <h1>Welcome to Admin Dashboard</h1>      
    <p>As an admin you can create users, change user details and privileges, create tours, modify tours, remove tours, create locations, modify and remove locations.</p>
  </div>
  <a href="account-details.php" style="width: 180px; margin-left: 16%" class="btn btn-info" role="button">Change Account Details</a> 
  <a href="booked-tours.php" style="width: 180px; margin-left: 10%" class="btn btn-info" role="button">View Booked Tours</a>
  <a href="book-tours.php" style="width: 180px; margin-left: 10%" class="btn btn-info" role="button">Booked Tours</a>
  <p style="text-align: center; color: red;"><br /><br/ ><?php echo "Welcome ".$_SESSION['username']."<br>Last Login: ".$_SESSION['last_login']; ?></p>
</div>

<?php
    include("../inc/footer.inc");
?>