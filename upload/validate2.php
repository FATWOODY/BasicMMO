<?php

require 'includes/header.php';

$email = htmlentities( stripslashes( $_GET['email'] ) );
$code = htmlentities( stripslashes( $_GET['code'] ) );
$code = rtrim( $code );
$code = ltrim( $code );

if ( !$email ) {
    $email = addslashes( $_POST['email'] );
    $code = htmlentities( stripslashes( $_POST['code'] ) );
} 

$query = "SELECT * FROM users WHERE uEmail=\"$email\"";
$result = $db->query( $query );

$row = $db->fetch( $result );

echo "<br><center>";

if ( !$row ) {
    echo "The email you entered was not found in our database. Please <A HREF='register.php'>Create an Account</a>.";
} elseif ( $row['uCode'] == "done" ) {
    echo "You account has already been activated.";
} elseif ( $row['uCode'] != $code ) {
    echo "The confirmation code you entered is invalid. Please <A HREF='validate.php'>go back</a> and enter it correctly.";
} elseif ( $row['uCode'] == $code ) {
    $query = "UPDATE users SET uCode='done' WHERE uEmail='$email'";
    $result = $db->query( $query );
    echo "Congratulations, your account has been activated. Please <A HREF='index.php'>Login</a>, and start playing.";
} 

echo "<br></center>";

require 'includes/footer.php';

?>
