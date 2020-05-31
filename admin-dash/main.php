<?php
    session_start();
    include('../inc/header.inc');
    include('nav.inc');
?>

<div class="container">
  <div class="jumbotron">
    <h1>Welcome to Admin Dashboard</h1>      
    <p>As an admin you can create users, change user details and privileges, create tours, modify tours, remove tours, create locations, modify and remove locations.</p>
  </div>
  <a href="user/user-dash.php" style="margin-left: 10%" class="btn btn-info" role="button">Users Dashboard</a> 
  <a href="tour/tour-dash.php" style="margin-left: 10%" class="btn btn-info" role="button">Tours and Locations</a>
  <a href="bookings.php" style="margin-left: 10%" class="btn btn-info" role="button">View All Bookings</a>
  <a href="user_activity.php" style="margin-left: 10%" class="btn btn-info" role="button">View User Activity</a>

  <p style="text-align: center; color: red;"><br /><br/ ><?php echo "Welcome ".$_SESSION['username']."<br>Last Login: ".$_SESSION['last_login']; ?></p>
</div>

<?php
    include('../inc/footer.inc');
?>
