<?php
session_start();
    include('/Library/WebServer/Documents/inc/header.inc');
    include('../nav.inc');

?>

<br><a href='create-location.php' class="btn btn-info" role="button"> Create Locations </a>
<br>
<br><a href='locations.php' class="btn btn-info" role="button"> View Locations </a>
<br>
<br><a href='new-tour.php' class="btn btn-info" role="button"> Create Tours </a>
<br>
<br><a href='tours.php' class="btn btn-info" role="button"> View Tours </a>
<br>
<br><a href='tourtype.php' class="btn btn-info" role="button"> Create Tours Type </a>

<?php
    include('/Library/WebServer/Documents/inc/footer.inc');
?>
