<?php

$ingame = "*";
require 'includes/header.php';
$weaponz1 = explode( ";", $user['uWeapon1'] . ";" . $user['uWeapon2'] . ";" . $user['uWeapon3'] . ";" . $user['uWeapon4'] . ";" . $user['uWeapon5'] );
$weaponz2 = explode( ";", $SETTINGS['wp_1_dmg'] . ";" . $SETTINGS['wp_2_dmg'] . ";" . $SETTINGS['wp_3_dmg'] . ";" . $SETTINGS['wp_4_dmg'] . ";" . $SETTINGS['wp_5_dmg'] );
$menleft = $user['uOffensiveMen'];
$offense = $user['uOffense'] + ( $menleft * 250 );
$x = 0;
while ( $x < 5 && $menleft != 0 ) {
    if ( $weaponz1[$x] >= $menleft ) {
        $offense = $offense + ( $menleft * $weaponz2[$x] );
        $menleft = 0;
    } else {
        $offense = $offense + ( $weaponz1[$x] * $weaponz2[$x] );
        $menleft = $menleft - $weaponz1[$x];
    } 
    $x++;
} 
$armourz1 = explode( ";", $user['uArmour1'] . ";" . $user['uArmour2'] . ";" . $user['uArmour3'] . ";" . $user['uArmour4'] . ";" . $user['uArmour5'] );
$armourz2 = explode( ";", $SETTINGS['ar_1_dmg'] . ";" . $SETTINGS['ar_2_dmg'] . ";" . $SETTINGS['ar_3_dmg'] . ";" . $SETTINGS['ar_4_dmg'] . ";" . $SETTINGS['ar_5_dmg'] );
$menleft = $user['uDefensiveMen'];
$defense = $user['uDefense'] + ( $menleft * 250 );
$x = 0;
while ( $x < 5 && $menleft != 0 ) {
    if ( $armourz1[$x] >= $menleft ) {
        $defense = $defense + ( $menleft * $armourz2[$x] );
        $menleft = 0;
    } else {
        $defense = $defense + ( $armourz1[$x] * $armourz2[$x] );
        $menleft = $menleft - $armourz1[$x];
    } 
    $x++;
} 
		/* +15% Offense */
		if ($user['uRace']==1||$user['uRace']==2||$user['uRace']==3) {
  		$offense = floor($offense+($offense*15/100));
		}
		/* +15% Defense */
		if ($user['uRace']==4||$user['uRace']==5||$user['uRace']==6) {
  		$defense = floor($defense+($defense*15/100));
		}

?>
					<b><tl>Base</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<table width="200" border="0">
				  <tr>
					<td width="60%">
					<b>Race<br>
					Gold<br>
					Bank<br>
					Population<br>
					Citizens<br>
					Offensive Men<br>
					Defensive Men<br>
					Miners<br>
					Offense<br>
					Defense<br>
					Attack Turns<br>
					Win / Lose<br>
					Level<br>
					Next Level<br>
					EXP<br>
					Mine Level<br>
					</td>
					<td width="40%">
					<?php
if ( $user['uRace'] == 1 ) {
    echo $SETTINGS['prace_1'];
} elseif ( $user['uRace'] == 2 ) {
    echo $SETTINGS['prace_2'];
} elseif ( $user['uRace'] == 3 ) {
    echo $SETTINGS['prace_3'];
} elseif ( $user['uRace'] == 4 ) {
    echo $SETTINGS['prace_4'];
} elseif ( $user['uRace'] == 5 ) {
    echo $SETTINGS['prace_5'];
} elseif ( $user['uRace'] == 6 ) {
    echo $SETTINGS['prace_6'];
} 

?><br>
					<?=$user['uGold']?><br>
					<?=$user['uBank']?><br>
					<?=$user['uCitizens'] + $user['uOffensiveMen'] + $user['uDefensiveMen'] + $user['uMiners']?><br>
					<?=$user['uCitizens']?><br>
					<?=$user['uOffensiveMen']?><br>
					<?=$user['uDefensiveMen']?><br>
					<?=$user['uMiners']?><br>
					<?=$offense?><br>
					<?=$defense?><br>
					<?=$user['uAttackTurns']?><br>
					<?=$user['uWon']?> / <?=$user['uLost']?><br>
					<?=$user['uLevel']?><br>
					<?=$user['uNextLevel']?><br>
					<?=$user['uEXP']?><br>
					<?=$user['uMineLevel']?><br>
					</td>
				  </tr>
				</table>
				<br />
					<b><tl>Referal Link</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
				<div class="nfotxt"><a href="<?=$SETTINGS['game_url']?>?u=<?=$user['uID']?>"><?=$SETTINGS['game_url']?>?u=<?=$user['uID']?></a></div>
				<br>
				Get your friends to click this link, and if they sign up, you will recieve 25000 Gold and 20 Citizens.

					<td class="recent">
									<b><tl>Poll</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
						<?php
$result = $db->fetch( $db->query( "SELECT * FROM polls ORDER BY pID DESC LIMIT 1" ) );
if ( $result ) {

    ?>
			<?php
    require 'includes/poll2.php';

    ?>
		<?php
} 
				
require 'includes/footer.php';

?>