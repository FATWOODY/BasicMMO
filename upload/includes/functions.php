<?php
function getpower($userid,$dpower_1,$dpower_2,$dpower_3,$dpower_4,$dpower_5,$plant_output) {
  $result = mysqli_query( "SELECT * FROM users WHERE uID=\"" . $userid . "\"" );
	$user = mysqli_fetch_array( $result );
  $usage = (($user['uArmour1']*$dpower_1)+($user['uArmour2']*$dpower_2)+($user['uArmour3']*$dpower_3)+($user['uArmour4']*$dpower_4)+($user['uArmour5']*$dpower_5));
  $power = ($user['uPlants']*$plant_output);
  		
		/* +10% POWER */
		if ($user['uRace']==4||$user['uRace']==5||$user['uRace']==6) {
  		$power = ($power+($power*10/100));
		}

  if ($power!=0&&$usage!=0) {
      $percentage = round($power / $usage * 100);
  } else {
	if ($power>=100) {
		$percentage = 100;
	} else {
    $percentage = 0;
}
  }
  if ($percentage>100) {
    $percentage = 100;
  }
  if ($percentage<0) {
  	$percentage = 0;  
  }	
  return $percentage;
}
?>