<?php
$cron = true;
require '../includes/setup.php';
$db->query( "UPDATE users SET uAttackTurns=uAttackTurns+10" );
$db->query( "UPDATE users SET uAttackTurns=uAttackTurnsMax WHERE uAttackTurns>uAttackTurnsMax" );
$db->query( "UPDATE users SET uGold=uGold+1000" );

$result = $db->query( "SELECT * FROM referal_list" );

while ( $users = $db->fetch( $result ) ) {
    $db->query( "UPDATE users SET uBank=uBank+25000,uCitizens=uCitizens+20 WHERE uID=" . $users['uReferer'] );
    $db->query( "DELETE FROM referal_list WHERE uReferer=" . $users['uReferer'] . " AND uReferee=" . $users['uReferee'] );
}


$db->close();

?>