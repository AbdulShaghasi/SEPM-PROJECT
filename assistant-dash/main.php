<?php
    session_start();
    include('../inc/header.inc');
    include('nav.inc');
?>

<div class="container">
  <div class="jumbotron">
    <h1>Welcome to Assistant Dashboard</h1>      
    <p>As an assistant you can create normal users, create tours, modify tours, create locations and modify location.</p>
  </div>
  <a href="create-user.php" style="margin-left: 21%" class="btn btn-info" role="button">Create New User</a>
  <a href="tour/tour-dash.php" style="margin-left: 10%" class="btn btn-info" role="button">Tours and Locations</a>
  <a href="bookings.php" style="margin-left: 10%" class="btn btn-info" role="button">View All Bookings</a>
  <p style="text-align: center; color: red;"><br /><br/ ><?php echo "Welcome ".$_SESSION['username']."<br>Last Login: ".$_SESSION['last_login']; ?></p>
</div>

<?php
    include('../inc/footer.inc');
?>
