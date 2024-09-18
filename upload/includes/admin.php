<?php

session_start();
$lin = $_SESSION['lin'];
if ( $lin == "y" ) {
} elseif ( $user['uRank'] != 1 ) {
    $_SESSION['lin'] = "y";
    echo "<meta http-equiv='refresh' content='1; url=index.php'>Redirecting, please hold on a moment.";
    exit();
} else {
    $_SESSION['lin'] = "n";
    echo "<meta http-equiv='refresh' content='1; url=../index.php'>";
    exit();
} 

?>