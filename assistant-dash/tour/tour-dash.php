<?php
session_start();
include('/Library/WebServer/Documents/inc/header.inc');
include('../nav.inc');

?>

<div class="container">
    <div class="jumbotron">
        <h1 style="font-size: 45px; text-align: center;">Welcome to Assistant Tours and Locations Dashboard</h1>
        <p style="text-align: center;">As an assistant you can create tours, modify tours, remove tours, create locations, modify and remove locations.</p>
    </div>
    <br><a href='create-location.php' style="width: 150px; margin-left: 28%" class="btn btn-info" role="button"> Create Location </a>
    <a href='locations.php' style="width: 150px; margin-left: 15%" class="btn btn-info" role="button"> View Location </a>
    <br>
    <br><a href='new-tour.php' style="width: 150px; margin-left: 28%" class="btn btn-info" role="button"> Create Tours </a>
    <a href='tours.php' style="width: 150px; margin-left: 15%" class="btn btn-info" role="button"> View Tours </a>
    <br>
    <br><a href='tourtype.php' style="width: 180px; margin-left: 41%" class="btn btn-info" role="button"> Create Tour Type </a>
</div>

<?php
include('/Library/WebServer/Documents/inc/footer.inc');
?>