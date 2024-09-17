<?php
require 'includes/setup.php';
session_start();
$_SESSION['ht_mem'] = rand( 0, 50000 ) . "logged_out_" . rand( 0, 50000 );
header( "Location: index.php" );
?>