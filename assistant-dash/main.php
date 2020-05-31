<?php
    session_start();
    include('/Library/WebServer/Documents/inc/header.inc');
    include('nav.inc');
    echo "Welcome ".$_SESSION['username']."<br>Last Login: ".$_SESSION['last_login'];
?>

<?php
    include('/Library/WebServer/Documents/inc/footer.inc');
?>
