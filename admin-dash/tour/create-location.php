<?php
session_start();

if (isset($_POST['locname'])) {
    $locName = $_POST['locname'];
    $XY = $_POST['XY'];
    $description = $_POST['description'];
    $min = $_POST['min'];

    $db = mysqli_connect("127.0.0.1", "root", "password", "SEPM")  or die(mysqli_error($db));
    $q = "INSERT INTO locations (location_name, XY_Coordinates, Description, Min_time_spent)
  VALUES ('$locName','$XY','$description','$min')";

    $results = mysqli_query($db, $q) or die(mysqli_error($db));

    $success = "Successfully added Location!";
}



include('/Library/WebServer/Documents/inc/header.inc');
include('../nav.inc');
if (isset($success) == true) {
    echo $success;
}
?>
<!-- (firstname, lastname, address, email, contact_num, username, password, account_type, reg_date, expiry_date) -->

<!-- start of main content -->
<div class="center">
    <div class="container login-container">
        <h2 style="position:center">New Location</h2>
        <form method="post" action="" name="location">
            <div class="form-group">
                <label for="firstname">Location Name:</label>
                <input type="text" class="form-control" placeholder="Enter Location Name" name="locname" required>
            </div>
            <div class="form-group">
                <label for="lastname">X-Y Corindates:</label>
                <input type="text" class="form-control" placeholder="E.g. 37.8136° S, 144.9631° E" name="XY" required>
            </div>
            <div class="form-group">
                <label for="Decription">Decription:</label>
                <textarea class="form-control" name="description" max-length='100' placeholder="Description" required></textarea>
            </div>
            <div class="form-group">
                <label for="min">Minimum time in Minutes:</label>
                <input type="min" class="form-control" placeholder="E.g. 60" name="min" required>
            </div>
            <button type="submit" class="btn btn-info">Create Location</button>
        </form><br>
    </div>
</div>


<!-- end of main content -->

<?php
include('/Library/WebServer/Documents/inc/footer.inc');
?>