<?php
session_start();
include("../inc/header.inc");
include("nav.inc");
$userID = $_SESSION['userID'];
$db = mysqli_connect("127.0.0.1", "root","password", "SEPM")  or die(mysqli_error($db));
$q= "SELECT * FROM bookings WHERE user_id = '$userID'";




    if ($result = mysqli_query($db, $q)) {


      while ($row = mysqli_fetch_row($result)) {
        $bookingID = $row[0];
        $tourID = $row[1];
        $_POST['tourid']
        $bookingDate = $row[3];


      }


    }

    // Fetch one and one row
    $q = "select * from Tours where tour_id = '$tourID'";
    $result = mysqli_query($db, $q);

    echo "
    <div class='center'>
        <div class = 'container login-container'>
            <h2 style='position:center'>Tour Details</h2>
    <table  width='80%'>
  <tr>
    <th>Tour Name</th>
    <th>Tour Type</th>
    <th>Duration</th>
    <th>Locations</th>
    <th></th>
  </tr>";

    while ($row = mysqli_fetch_row($result)) {
      //printf ("%s %s %s %s\n", $row[1], $row[2], $row[3], $row[4]."<br>");
      $tourid = $row[0];
      $name = $row[1];
      $type = $row[2];
      $duration = $row[3];


  echo"
    <tr>
      <td>$name</td>
      <td>$type</td>
      <td>$duration</td>
      <td>";




      echo "</td>
      <td>


      <button type='submit' class='btn btn-link'>View all Tours </button>
      </form>
      </td>
    </tr>";


    }


    echo "</table>
    </div>
    </div>";
    mysqli_free_result($result);

?>

<?php
    include("../inc/footer.inc");
?>
