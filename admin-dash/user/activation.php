<?php
session_start();
if (isset($_POST['username'])) {
  $username = $_POST['username'];
  $activation = $_POST['activation'];
  $account_type = $_POST['Account_Type'];


  $db = mysqli_connect("127.0.0.1", "root", "password", "SEPM")  or die(mysqli_error($db));

  if ($_POST['activation'] == 'Activate') {
    $q = "UPDATE users SET account_type='$account_type' WHERE username='$username'";
  }
  if ($_POST['activation'] == 'Deactivate') {
    $q = "UPDATE users SET account_type='$activation' WHERE username='$username'";
  }

  $results = mysqli_query($db, $q) or die(mysqli_error($db));

  $success = "User Successfully " . $activation . "d.";
}
include('/Library/WebServer/Documents/inc/header.inc');
include('../nav.inc');
if (isset($success)) echo $success;
?>

<div class="center">
  <div class="container login-container">
    <h2 style="position:center">Account Activation</h2>
    <form method="post" action="">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" placeholder="Enter Username" name="username" required>
      </div>
      <div class="form-group">
        <input type="radio" id="Activate" name="activation" value="Activate" checked>
        <label for="Activate">Activate</label><br>
        <input type="radio" id="Deactivate" name="activation" value="Deactivate">
        <label for="Deactivate">Deactivate</label><br>
      </div>
      <div class="form-group">
        <label for="Account_Type">Choose account type:</label>
        <select id="Account_Type" name="Account_Type" required>
          <option disabled selected value> -- select an option -- </option>
          <option value="admin">Admin</option>
          <option value="assistant">Assistant</option>
          <option value="user">Normal User</option>
        </select>
      </div>
      <button type="submit" class="btn btn-info">Update User</button>
    </form><br>
  </div>
</div>

<?php
include('../../inc/footer.inc');
?>