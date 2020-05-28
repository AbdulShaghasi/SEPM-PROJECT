<?php
session_start();



if (isset($_POST['tourName'])) {
  $tourName = $_POST['tourName'];
  $tourType = $_POST['tourType'];
  $locations = $_POST['locations'];

  $allLocations ;

  foreach ($locations as $key => $value) {
    $thing = explode(",",$value);
    $allLocations = $allLocations . $thing[0].",";
    $duration = $duration + $thing[1];


    //$allLocations = $value.",";
    //echo $value;
  }

  $db = mysqli_connect("127.0.0.1", "root","password", "SEPM")  or die(mysqli_error($db));
  $q = "INSERT INTO tours (tour_name, tour_type, duration, location)
  VALUES ('$tourName','$tourType','$duration','$allLocations')";
  mysqli_query($db, $q) or die(mysqli_error($db));
}




    include('/Library/WebServer/Documents/inc/header.inc');
    include('../nav.inc');

    $db = mysqli_connect("127.0.0.1", "root","password", "SEPM")  or die(mysqli_error($db));
    $q = "select * from locations";




?>

<!-- start of main content -->
<div class="center">
    <div class = "container login-container">
        <h2 style="position:center">New Tour</h2>
            <form method="post" action="" name="Tour">
                <div class = "form-group">
                    <label for="firstname">Tour Name:</label>
                    <input type="text" class="form-control" placeholder="Enter Location Name" name="tourName" required>
                </div>
                <div class = "form-group">
                    <label for="lastname">Tour Type:</label>
                    <input type="text" class="form-control" placeholder="E.g. 37.8136° S, 144.9631° E" name="tourType" required>
                </div>
                <div class = "form-group">
                  <label for="Locations">Locations:</label>
                  <br>
                  <?php
                  if ($result = mysqli_query($db, $q)) {



                 while ($row = mysqli_fetch_row($result)) {
                   //printf ("%s %s %s %s\n", $row[1], $row[2], $row[3], $row[4]."<br>");

                   echo"
                   <input type='checkbox' id=".$row[0]." name='locations[]' value=".$row[0].",".$row[4].",".">
                <label for=".$row[0]."> ".$row[1]."</label><br>";

                 }
                 mysqli_close($db);

                }
                   ?>
                </div>
                <button type="submit" class="btn btn-info">Create Tour</button>
            </form><br>
        </div>
</div>

<?php
    include('/Library/WebServer/Documents/inc/footer.inc');
?>
