<?php
session_start();
include('/Library/WebServer/Documents/inc/header.inc');
include('inc/nav.inc');






    $db = mysqli_connect("127.0.0.1", "root","password", "SEPM")  or die(mysqli_error($db));
    $q = "select * from Tours";


   if ($result = mysqli_query($db, $q)) {
  // Fetch one and one row

  echo "
  <div class='center'>
      <div class = 'container login-container'>
          <h2 style='position:center'>Our Tours</h2>
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

echo"
  <tr>
    <td>$row[1]</td>
    <td>$row[2]</td>
    <td>$row[3]</td>
    <td>$row[4]</td>
    <td>
    <form method='post' action''>

    <button type='submit' class='btn btn-link' value = $row[4]>Book Tour</button>
    </form>
    </td>
  </tr>";


  }
  echo "</table>
  </div>
  </div>";
  mysqli_free_result($result);
}



?>



<?php
    include('/Library/WebServer/Documents/inc/footer.inc');
?>
