<?php
//start session and set nav
session_start();



//allow the user to go back to viewing all locations instead of editing one
if (isset($_POST['unset'])) {
  unset($_POST);
  header("Location: tours.php");
}



//database variables
$db = mysqli_connect("127.0.0.1", "root", "password", "SEPM")  or die(mysqli_error($db));

if (isset($_POST['location_name'])) {


  //set location
  if (empty($_POST['location_name'])) {
    $locationName = $_POST['location_nameOR'];
  } else {
    $locationName = $_POST['location_name'];
  }
  //set coords
  if (empty($_POST['coordinates'])) {
    $coords = $_POST['coordinatesOR'];
  } else {
    $coords = $_POST['coordinates'];
  }
  //set description
  if (empty($_POST['description'])) {
    $description = $_POST['descriptionOR'];
  } else {
    $description = $_POST['description'];
  }
  //set minTime
  if (empty($_POST['minTime'])) {
    $minTime = $_POST['minTimeOR'];
  } else {
    $minTime = $_POST['minTime'];
  }

  $location = $_POST['locationID'];


  $q = "UPDATE locations SET location_name = '$locationName', XY_Coordinates = '$coords', Description = '$description', Min_time_spent = '$minTime' WHERE location_id = $location";
  mysqli_query($db, $q);


  $update = 'true';
  unset($_POST);
  header("Location: locations.php?update=true");
} else if (isset($_GET['delete'])) {
  $delete = $_GET['delete'];
  $q = "DELETE FROM locations Where location_id = '$delete'";
  mysqli_query($db, $q) or die(mysqli_error($db));
  $message = "Successfully Deleted Location";
}

//if edit is set we show the location editor otherwise we display all locations
else if (isset($_POST['location_id'])) {

  include('/Library/WebServer/Documents/inc/header.inc');
  include('../nav.inc');

  $location = $_POST['location_id'];
  $q = "SELECT * FROM locations WHERE location_id='$location'";

  if ($result = mysqli_query($db, $q)) {



    while ($row = mysqli_fetch_row($result)) {
      $locationID = $row[0];
      $locationName = $row[1];
      $coords = $row[2];
      $description = $row[3];
      $minTime = $row[4];




      echo "<div class='center'>
       <div class = 'container login-container'>
           <h2 style='position:center'>Edit Location</h2>
               <form method='post' action=''>
                 <div class = 'form-group'>
                     <label for='location_name'>Location Name:</label>
                     <input type='text'class='form-control' name='location_name' placeholder='$row[1]'>
                     <input type='hidden'class='form-control' name='location_nameOR' value='$row[1]'>
                  </div>
                  <div class = 'form-group'>
                      <label for='coordinates'>Coordinates:</label>
                      <input type='text'class='form-control' name='coordinates' placeholder='$row[2]'>
                      <input type='hidden'class='form-control' name='coordinatesOR' value='$row[2]'>
                   </div>
                   <div class = 'form-group'>
                       <label for='Description'>Description:</label>
                       <textarea class='form-control' name='description' max-length='100'  placeholder='$row[3]' ></textarea>
                       <input type='hidden'class='form-control' name='descriptionOR' value='$row[3]'>
                    </div>
                    <div class = 'form-group'>
                        <label for='minTime'>Minimum Time:</label>
                        <input type='text'class='form-control' name='minTime' placeholder='$row[4]'>
                        <input type='hidden'class='form-control' name='minTimeOR' value='$row[4]'>
                        <input type='hidden'class='form-control' name='locationID' value='$location'>
                     </div>
                     <button type='submit' class='btn btn-info'>Update Location</button>
                     <a href='tours.php?delete=$locationID' class='btn btn-danger' role='button'> Delete Location </a>
               </form><br>
               <form method='post' action''>
                 <input type='hidden' value='true' name='unset'>
               <button type='submit' class='btn btn-info'>Go Back </button>
               </form>
           </div>
   </div>";
    }

    mysqli_free_result($result);
  }
} else {
  include('/Library/WebServer/Documents/inc/header.inc');
  include('../nav.inc');

  if (isset($_GET['update'])) {
    echo "Location successfully updated.";
    unset($_GET['update']);
  }


  $q = "select * from locations";

  if ($result = mysqli_query($db, $q)) {
    // Fetch one and one row

    echo "
  <div class='center'>
      <div class = 'container login-container'>
          <h2 style='position:center'>Location Details</h2>
  <table  width='80%'>
<tr>
  <th>Location Name</th>
  <th>Coordinates</th>
  <th>Description</th>
  <th>Minimum Time</th>
  <th></th>
</tr>";

    while ($row = mysqli_fetch_row($result)) {
      //printf ("%s %s %s %s\n", $row[1], $row[2], $row[3], $row[4]."<br>");

      echo "
  <tr>
    <td>$row[1]</td>
    <td>$row[2]</td>
    <td>$row[3]</td>
    <td>$row[4]</td>
    <td>
    <form method='post' action='locations.php'>
      <input type='hidden' value=$row[0] name='location_id'>
    <button type='submit' class='btn btn-link'>Edit </button>
    </form>
    </td>
  </tr>";
    }
    echo "</table>
  </div>
  </div>";
    mysqli_free_result($result);
  }
}

?>

<?php
include('/Library/WebServer/Documents/inc/footer.inc');
?>
