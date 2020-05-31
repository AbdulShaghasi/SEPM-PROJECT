<?php
session_start();
include('/Library/WebServer/Documents/inc/header.inc');
if(!isset($_SESSION['username'])){
include('inc/nav.inc');
}
else {

  include("users-dash/nav.inc");
}



  $db = mysqli_connect("127.0.0.1", "root","password", "SEPM")  or die(mysqli_error($db));

//fetch locations
     $q = "select * from locations";
     if ($result = mysqli_query($db, $q)) {
       $x = 0;
       while ($row = mysqli_fetch_row($result)) {

         $list[] =  array($x =>  $row[0], $row[1]);
         $x++;
       }
     }




  // Fetch one and one row
  $q = "select * from Tours";
  $result = mysqli_query($db, $q);

  echo "
  <div class='center'>
      <div class = 'container login-container'>
          <h2 style='position:center'>Tour Details</h2>
  <table  width='80%' class=\"table\">
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
    $location = $row[4];

echo"
  <tr>
    <td>$name</td>
    <td>$type</td>
    <td>$duration</td>
    <td>";

$loc = explode(",", $location);

$i =0;



foreach ($list as  $val){

if (strpos($location, $val[$i]) !== false) {
    echo $val[$i+1]. " ";
}



$i++;

}


    echo "</td>
    <td>

    <form method='post' action='users-dash/bookings.php'>
    <input type='hidden' value=$tourid name='tourID'>
    <input type='hidden' value=$name name='tourName'>
    <input type='hidden' value=$type name='tourType'>
    <input type='hidden' value=$duration name='tourDuration'>
    <input type='hidden' value=$location name='tourLocation'>
    <button type='submit' class='btn btn-link'>Book Tour </button>
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
    include('/Library/WebServer/Documents/inc/footer.inc');
?>
