<?php
session_start();

$db = mysqli_connect("127.0.0.1", "root","password", "SEPM")  or die(mysqli_error($db));

if (isset($_POST['unset'])){
  unset($_POST);
  header("Location: tours.php");
}

if (isset($_POST['userID'])){
//  var_dump($_POST);

$today = date("Y-m-d H:i:s");
$userID = $_POST['userID'];
$tourID = $_POST['tourID'];


$a = "INSERT INTO bookings (tour_id, user_id, booking_date)
VALUES ('$tourID','$userID','$today')";
mysqli_query($db, $a) or die(mysqli_error($db));

$message = "Booking successfully made.";
unset($_POST);
header("Location: booked-tours.php");

}

else{

if(isset($message)){
  echo $message;
  unset($message);
}

include('../inc/header.inc');
if(!isset($_SESSION['username'])){
include('../inc/nav.inc');
echo "Please Log in then try booking again";
}
else {

include("nav.inc");

$tourID = $_POST['tourID'];
$tourName = $_POST['tourName'];
$tourType = $_POST['tourType'];
$tourDuration = $_POST['tourDuration'];
$tourLocation = $_POST['tourLocation'];
$username = $_SESSION['username'];



$q = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($db, $q);
  while ($row = mysqli_fetch_row($result)) {
    $userID = $row[0];
    $firstName = $row[1];
    $lastName = $row[2];
    $email = $row[4];
    $number = $row[5];
  }

?>

<div class="center">
    <div class = "container login-container">
        <h2 style="position:center">Booking Information</h2>
            <form method="post" action="">
                <div class = "form-group">
                    <label for="tourName">Tour Name:</label>
                    <input type="text" class="form-control" value="<?php echo $tourName;?>"  name="tourName" readonly>
                    <input type="hidden" value=<?php echo $userID;?> name="userID">
                    <input type="hidden" value=<?php echo $tourID;?> name="tourID">
                </div>
                <div class="form-group">
                    <label for="tourType">Tour Type:</label>
                    <input type="text" class="form-control" value="<?php echo $tourType;?>"  name="tourType" readonly>
                </div>
                <div class="form-group">
                    <label for="duration">Duration:</label>
                    <input type="text" class="form-control" value="<?php echo $tourDuration;?>"  name="duration" readonly>
                </div>
                <div class="form-group">
                    <label for="conName">Contact Name:</label>
                    <input type="text" class="form-control" value="<?php echo $firstName ;?>"  name="conName" readonly>
                </div>
                <div class="form-group">
                    <label for="conEmail">Contact Email:</label>
                    <input type="text" class="form-control" value="<?php echo $email ;?>"  name="conEmail" readonly>
                </div>
                <div class="form-group">
                    <label for="conNum">Contact Number:</label>
                    <input type="text" class="form-control" value="<?php echo $number ;?>"  name="conNum" readonly>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="agreement" required>I accept the bookings terms and conditions and verified all information is current and corrrect.</label>
                </div>

                <button type="submit" class="btn btn-info">Book Tour</button>
            </form><br>
        </div>
</div>

<?php
}
}
    include('../inc/footer.inc');
?>