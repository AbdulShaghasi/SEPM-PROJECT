<?php
session_start();
$db = mysqli_connect("127.0.0.1", "root","password", "SEPM")  or die(mysqli_error($db));


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


  $q = "INSERT INTO tours (tour_name, tour_type, duration, location)
  VALUES ('$tourName','$tourType','$duration','$allLocations')";
  mysqli_query($db, $q) or die(mysqli_error($db));
  echo "Tour successfully Created";
}




    include('/Library/WebServer/Documents/inc/header.inc');
    include('../nav.inc');







?>

<!-- start of main content -->
<div class="center">
    <div class = "container login-container">
        <h2 style="position:center">New Tour</h2>
            <form method="post" action="" name="Tour">
                <div class = "form-group">
                    <label for="tourName">Tour Name:</label>
                    <input type="text" class="form-control" placeholder="Enter Location Name" name="tourName" required>
                </div>
                <div class = "form-group">
                  <label for="TourType">Tour Type:</label>
                  <select id="tourType" name="tourType" required>
                    <option disabled selected value> -- Select a Tour Type -- </option>
                  <?php
                  $q = "select * from tourTypes";
                  if ($result = mysqli_query($db, $q)) {



                 while ($row = mysqli_fetch_row($result)) {
                   //printf ("%s %s %s %s\n", $row[1], $row[2], $row[3], $row[4]."<br>");

                   echo"
                   <option value='".$row[1]."'>"; echo $row[1]."</option>";

                 }


                }
                   ?>
                   </select>
                   <br><a href='tourtype.php' class="btn btn-info" role="button"> Create Tours Type </a>
                   </div>
                <div class = "form-group">
                  <label for="Locations">Locations:</label>
                  <br>
                  <?php
                  $q = "select * from locations";
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
