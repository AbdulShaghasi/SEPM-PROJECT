<?php
//start session and set nav
session_start();
include('../inc/header.inc');
include('nav.inc');

$db = mysqli_connect("127.0.0.1", "root", "password", "SEPM")  or die(mysqli_error($db));

// query database table
$q = "SELECT * FROM users";
$result = mysqli_query($db, $q);


// print table with header user firstname, lastname, contact number, email, expiry date, last login
echo "
<div class='center'>
    <div class = 'container login-container'>
        <h2 style='position:center'>Users Activity</h2>
        <table  width='80%' class=\"table\">
            <tr style=\"background-color: red; color: white;\">
                <th>username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Contact Number</th>
                <th>Last Login</th>
                <th>Account Expiry Date</th>
            </tr>";

// fetch data from result variable
while ($row = mysqli_fetch_row($result)) {
    $username = $row[6];
    $firstname = $row[1];
    $lastname = $row[2];
    $contact = $row[5];
    $lastlogin = $row[11];
    $expiry = $row[10];

    // echo the result in as table row and description
    echo"
    <tr>
      <td>$username</td>
      <td>$firstname</td>
      <td>$lastname</td>
      <td>$contact</td>
      <td>$lastlogin</td>
      <td>$expiry</td>
    </tr>";
}
    echo "
            </table>
        </div>
    </div>";
  mysqli_free_result($result);

?>

<?php
include("../inc/footer.inc");
?>

