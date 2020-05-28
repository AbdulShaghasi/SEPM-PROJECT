<?php
session_start();
    include('/Library/WebServer/Documents/inc/header.inc');
    include('../nav.inc');
?>

<br><a href="create-user.php" class="btn btn-info" role="button">Create User</a>
<br>
<br><a href="activation.php" class="btn btn-info" role="button">Activate / Deactivate User</a>
<br>
<br><a href="update-details.php" class="btn btn-info" role="button">Update User Account Details</a>
<br>

<?php
    include('/Library/WebServer/Documents/inc/footer.inc');
?>
