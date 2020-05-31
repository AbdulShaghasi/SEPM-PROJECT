<?php
session_start();
include('../../inc/header.inc');
include('../nav.inc');
?>

<div class="container">
    <div class="jumbotron">
        <h1 style="text-align: center;">Welcome to Admin User Dashboard</h1>
        <p style="text-align: center;">As an admin you can create users, change user details and privileges</p>
    </div>
    <a href="create-user.php" style="margin-left: 17%" class="btn btn-info" role="button">Create New User</a>
    <a href="activation.php" style="margin-left: 10%" class="btn btn-info" role="button">Activate / Deactivate User</a>
    <a href="update-details.php" style="margin-left: 10%" class="btn btn-info" role="button">Update Account Details</a>
    <br>
</div>
<?php
include('../../inc/footer.inc');
?>
