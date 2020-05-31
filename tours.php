<?php
session_start();


//allow the user to go back to viewing all locations instead of editing one
if (isset($_POST['unset'])){
  unset($_POST);
  header("Location: tours.php");
}




    $db = mysqli_connect("127.0.0.1", "root","password", "SEPM")  or die(mysqli_error($db));

//if the tour name has been posted we can update the tour
if (isset($_POST['tour_name'])){


//set location
  if (empty($_POST['tour_name'])){
  $tourName = $_POST['tour_nameOR'];
  }
  else {
    $tourName = $_POST['tour_name'];
  }
//set coords
  if (empty($_POST['tour_type'])){
    $tour_type = $_POST['tour_typeOR'];
  }
  else {
    $tour_type = $_POST['tour_type'];
  }

$locations = $_POST['locations'];

$tourID = $_POST['tour_ID'];

foreach ($locations as $key => $value) {
  $thing = explode(",",$value);
  $allLocations = $allLocations . $thing[0].",";
  $duration = $duration + $thing[1];



}

$q = "UPDATE tours SET tour_name = '$tourName', tour_type ='$tour_type', duration = '$duration', location = '$allLocations' WHERE tour_id = '$tourID'";
mysqli_query($db, $q) or die(mysqli_error($db));
$message =  "Tour successfully Updated";
$_POST['unset'] = true;
}

else if (isset($_GET['delete'])){
  $delete = $_GET['delete'];
  $q = "DELETE FROM tours Where tour_id = '$delete'";
  mysqli_query($db, $q) or die(mysqli_error($db));
  $message = "Successfully Deleted Tour";
}

include('/Library/WebServer/Documents/inc/header.inc');
include('../nav.inc');

    //if edit is set we show the location editor otherwise we display all locations
  if (isset($_POST['tour_id'])){



    $tour = $_POST['tour_id'];
      $q = "SELECT * FROM tours WHERE tour_id='$tour'";

      if ($result = mysqli_query($db, $q)) {



     while ($row = mysqli_fetch_row($result)) {
       $tourID =$row[0];
       $tourName = $row[1];
       $tourType = $row[2];
       $locations = $row[4];




      echo "<div class='center'>
           <div class = 'container login-container'>
               <h2 style='position:center'>Edit Tour</h2>
                   <form method='post' action=''>
                     <div class = 'form-group'>
                         <label for='location_name'>Tour Name:</label>
                         <input type='text'class='form-control' name='tour_name' placeholder='$tourName'>
                         <input type='hidden'class='form-control' name='tour_nameOR' value='$tourName'>
                         <input type='hidden'class='form-control' name='tour_ID' value='$tourID'>


                      </div>
                      <div class = 'form-group'>
                        <label for='TourType'>Tour Type:</label>
                        <input type='hidden'class='form-control' name='tour_typeOR' value='$tourType'>
                        <select id='tourType' name='tourType' required>
                          <option disabled selected value='$tourType'>$tourType</option>";

                        $q = "select * from tourTypes";
                        if ($result = mysqli_query($db, $q)) {



                       while ($row = mysqli_fetch_row($result)) {
                         //printf ("%s %s %s %s\n", $row[1], $row[2], $row[3], $row[4]."<br>");

                         echo"
                         <option value='".$row[1]."'>"; echo $row[1]."</option>";

                       }


                      }
                        echo "
                         </select>
                         <br><a href='tourtype.php' class='btn btn-info' role='button'> Create Tours Type </a>
                         </div>
                         <div>
                         <label for='Locations'>Locations:</label><br>";

                         $q = "select * from locations";
                         if ($result = mysqli_query($db, $q)) {

                        while ($row = mysqli_fetch_row($result)) {
                          //printf ("%s %s %s %s\n", $row[1], $row[2], $row[3], $row[4]."<br>");

                          echo"
                          <input type='checkbox' id=".$row[0]." name='locations[]' value=".$row[0].",".$row[4].","."  ";
                           if (strpos($locations, $row[0]) !== false) {
                             echo "checked";
                           }
                            echo"
                           >
                       <label for=".$row[0]."> ".$row[1]."</label><br>";

                        }


                       }
                         echo "</div>
                         <button type='submit' class='btn btn-info'>Update Tour</button>
                          <a href='tours.php?delete=$tourID' class='btn btn-danger' role='button'> Delete Tour </a>
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
    }






   else {

     if (isset($message)){
       echo $message;
       unset($message);
     }

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

    <form method='post' action''>
    <input type='hidden' value=$tourid name='tour_id'>
    <button type='submit' class='btn btn-link'>Edit </button>
    </form>
    </td>
  </tr>";


  }

//   <div>
//   <label for='Locations'>Locations:</label><br>";
//
//   $q = "select * from locations";
//   if ($result = mysqli_query($db, $q)) {
//
//  while ($row = mysqli_fetch_row($result)) {
//    //printf ("%s %s %s %s\n", $row[1], $row[2], $row[3], $row[4]."<br>");
//
//    echo"
//    <input type='checkbox' id=".$row[0]." name='locations[]' value=".$row[0].",".$row[4].","."  ";
//     if (strpos($locations, $row[0]) !== false) {
//       echo "checked";
//     }
//      echo"
//     >
// <label for=".$row[0]."> ".$row[1]."</label><br>";
//
//  }
//
//
// }
//   echo "</div>
  echo "</table>
  </div>
  </div>";
  mysqli_free_result($result);
}



?>



<?php
    include('/Library/WebServer/Documents/inc/footer.inc');
?>
