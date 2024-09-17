<?php
$cron = true;
require '../includes/setup.php';

$db->query( "UPDATE users SET uCitizens=uCitizens+(10*uLevel)" );

$db->query( "UPDATE users SET uBank=uBank+round((uBank+1/100)*(uInterestRate/100))" );
$db->query( "UPDATE users SET uBank=uBank+(uMineLevel*(uMiners*1000))" );
$db->query( "UPDATE users SET uDeposits=uDepositsMax,uRandomEvents=uRandomEventsMax" );

$db->query( "UPDATE users SET uTypeDays=uTypeDays-1 WHERE uTypeDays>0" );
$db->query( "UPDATE users SET uType=1 WHERE uTypeDays=0" );

$xtime = time() - ( 60 * 60 * 24 );
$ytime = time() - ( 60 * 60 * 24 * 7 );
$db->query( "DELETE FROM logs WHERE lTime2<$xtime" );
$db->query( "DELETE FROM messages WHERE mTime2<$ytime" );

$db->close();

?>