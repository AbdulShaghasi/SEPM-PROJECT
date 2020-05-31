<?php
//start session and set nav
session_start();
$db = mysqli_connect("127.0.0.1", "root", "password", "SEPM")  or die(mysqli_error($db));

if (isset($_POST['delete'])) {
  //echo "delete";
  $bookID = $_POST['delete'];
  $q = "DELETE FROM bookings WHERE booking_id = '$bookID'";
  mysqli_query($db, $q);
  unset($_POST);
}

include('/Library/WebServer/Documents/inc/header.inc');
include('nav.inc');




$q = "SELECT * FROM tours";
$result = mysqli_query($db, $q);
$i = 0;
while ($row = mysqli_fetch_row($result)) {
  $tours[] = array($i => $row[0], $row[1]);

  $i++;
}

$q = "SELECT * FROM users";
$result = mysqli_query($db, $q);
$i = 0;
while ($row = mysqli_fetch_row($result)) {
  $users[] = array($i => $row[0], $row[6]);

  $i++;
}



$q = "SELECT * FROM bookings";
$result = mysqli_query($db, $q);



echo "
<div class='center'>
    <div class = 'container login-container'>
        <h2 style='position:center'>Booked Tours</h2>
<table  width='80%' class=\"table\">
<tr>
<th>Booking Number</th>
<th>Booking Date</th>
<th>Tour Name</th>
<th>User Name</th>
<th></th>
</tr>";

while ($row = mysqli_fetch_row($result)) {
  //printf ("%s %s %s %s\n", $row[1], $row[2], $row[3], $row[4]."<br>");
  $bookingNum = $row[0];
  $bookingTourID = $row[1];
  $bookingUserID = $row[2];
  $bookingDate = $row[3];


  echo "
<tr>
  <td>$bookingNum</td>
  <td>$bookingDate</td>
  <td>";
  $i = 0;
  foreach ($tours as $val) {

    if ($val[$i] == $bookingTourID) {
      echo $val[$i + 1];
    }

    $i++;
  }



  echo "</td>
  <td>";
  $i = 0;
  foreach ($users as $res) {

    if ($res[$i] == $bookingUserID) {
      echo $res[$i + 1];
    }

    $i++;
  }

  echo "</td>
  <td>

  <form method='post' action''>
  <input type='hidden' value=$bookingNum name='delete'>
  <button type='submit' class='btn btn-link'>Cancel Booking</button>
  </form>
  </td>
</tr>";
}


echo "</table>
</div>
</div>";


?>

<?php
include('/Library/WebServer/Documents/inc/footer.inc');
?>
