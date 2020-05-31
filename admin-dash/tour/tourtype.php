<?php
session_start();

$db = mysqli_connect("127.0.0.1", "root", "password", "SEPM")  or die(mysqli_error($db));


//allow the user to go back to viewing all locations instead of editing one
if (isset($_POST['unset'])) {
  unset($_POST);
  header("Location: tours.php");
}

if (isset($_POST['tour_name'])) {
  $tour_type = $_POST['tour_name'];
  $tour_id = $_POST['tour_id'];
  //var_dump($_POST);


  $q = "UPDATE tourTypes SET tour_type = '$tour_type' WHERE type_id = $tour_id";
  mysqli_query($db, $q);


  $update = 'Successfully updated Tour Type!';
  unset($_POST);
  header("Location: tourType.php");
}

//insert new tour type
else if (isset($_POST['newtype'])) {
  $type = $_POST['newtype'];


  $q = "INSERT INTO tourTypes (tour_type)
VALUES ('$type')";

  $results = mysqli_query($db, $q) or die(mysqli_error($db));

  $success = "Successfully added Tour Type!";
  unset($_POST);
  header("Location: tourType.php");
} else if (isset($_GET['delete'])) {
  $delete = $_GET['delete'];
  $q = "DELETE FROM tourTypes Where type_id = '$delete'";
  mysqli_query($db, $q) or die(mysqli_error($db));
  $deleted = "Successfully Deleted Tour Type";
}

include('../../inc/header.inc');
include('../nav.inc');

//if edit is set we show the location editor otherwise we display all locations
if (isset($_POST['type_id'])) {
  $tour_id = $_POST['type_id'];



  $tour_id = $_POST['type_id'];
  $q = "SELECT * FROM tourTypes WHERE type_id='$tour_id'";

  if ($result = mysqli_query($db, $q)) {



    while ($row = mysqli_fetch_row($result)) {
      $tour_type = $row[1];


      echo "
              <div class='center'>
       <div class = 'container login-container'>
           <h2 style='position:center'>Edit Tour Type - " . $tour_type . "</h2>
               <form method='post' action=''>
                 <div class = 'form-group'>
                     <label for='tour_name'>Tour Name:</label>
                     <input type='text'class='form-control' name='tour_name' placeholder='$row[1]'>
                     <input type='hidden'class='form-control' name='tour_id' value='$row[0]'>
                  </div>

                     <button type='submit' class='btn btn-info'>Update Tour Type</button>
                     <a href='tourtype.php?delete=$row[0]' class='btn btn-danger' role='button'> Delete Tour Type </a>
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
  if (isset($success)) {
    echo $success;
  }
  if (isset($update)) {
    echo $update;
  }
  if (isset($deleted)) {
    echo $deleted;
  }
?>
  <!-- start of main content -->
  <div class="center">
    <div class="container login-container">
      <h2 style="position:center">New Tour Type</h2>
      <form method="post" action="" name="Tour">
        <div class="form-group">
          <label for="type">Tour Type:</label>
          <input type="text" class="form-control" placeholder="Enter New Tour Type" name="newtype" required>
        </div>

        <button type="submit" class="btn btn-info">Create Tour Type</button>

      </form><br>
    </div>
  </div>


<?php
  $q = "select * from tourTypes";

  if ($result = mysqli_query($db, $q)) {
    // Fetch one and one row

    echo "
  <div class='center'>
      <div class = 'container login-container'>
          <h2 style='position:center'>Exisiting Tour Types</h2>
  <table  width='80%'>
<tr>
  <th>Tour Type</th>
  <th></th>
</tr>";

    while ($row = mysqli_fetch_row($result)) {
      //printf ("%s %s %s %s\n", $row[1], $row[2], $row[3], $row[4]."<br>");

      echo "
  <tr>
    <td>$row[1]</td>
    <td>
    <form method='post' action='tourType.php'>
      <input type='hidden' value=$row[0] name='type_id'>
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