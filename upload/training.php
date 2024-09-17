<?php

$ingame = "*";
require 'includes/header.php';

/*
DISCOUNTS HAVE BEEN DISABLED
if ( $user['uType'] == 3 ) {
    $discount = 5;
}
if ( $user['uType'] == 4 ) {
    $discount = 10;
} 
*/

$a1cost = $SETTINGS['off_men_cst'] - ( ( $SETTINGS['off_men_cst'] / 100 ) * $discount );
$a2cost = $SETTINGS['def_men_cst'] - ( ( $SETTINGS['def_men_cst'] / 100 ) * $discount );
$a3cost = $SETTINGS['min_men_cst'] - ( ( $SETTINGS['min_men_cst'] / 100 ) * $discount );

if ( !$_POST[train] && !$_POST[untrain] ) {

    ?>
    					<b><tl>Training</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<form action="training.php" method="post">
	<table width="500"  border="0">
	  <tr>
		<td colspan="4" class="bodycell4">
			<center>
			You have <?=$user['uCitizens']?> citizens available to train, and <?=$user['uGold']?> gold to spend.
			</center>
		</td>
	  </tr>
	  <tr>
		<td class="bodycell4" width="100%">
		<table width="100%"><tr><td><b>Type</b></td><td align="center"><b>You Have</b></td><td align="center"><b>Cost</b></td><td><b>Number of units</b></td></tr>
		<tr><td>Offensive Men</td><td align="center"><?=$user['uOffensiveMen']?></td><td align="center"><?=$a1cost?></td><td><input name="offmen" type="text" value="0" size="5" maxlength="5"></td></tr>
		<tr><td>Defensive Men</td><td align="center"><?=$user['uDefensiveMen']?></td><td align="center"><?=$a2cost?></td><td><input name="defmen" type="text" value="0" size="5" maxlength="5"></td></tr>
		<tr><td>Miners</td><td align="center"><?=$user['uMiners']?></td><td align="center"><?=$a3cost?></td><td><input name="minmen" type="text" value="0" size="5" maxlength="5"></td></tr>
		</table>			
		</td>
	  </tr>
	  <tr>
		<td colspan="4" class="bodycell4">
			<center>
			<input name="train" type="submit" value="Train">
			<input name="untrain" type="submit" value="Untrain">
			</center>
		</td>
	  </tr>
	</table>
	</form>
	<?php
} elseif ( $_POST['train'] ) {

    ?>
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell3">Training</td>
	  </tr>
	  <tr>
		<td class="bodycell4" align="center">
		<?php
    $offmen = round( str_replace( "-", "", $_POST['offmen'] ) );
    $defmen = round( str_replace( "-", "", $_POST['defmen'] ) );
    $minmen = round( str_replace( "-", "", $_POST['minmen'] ) );
    $totmen = $offmen + $defmen + $minmen;
    $thecost = ( $offmen * $a1cost ) + ( $defmen * $a2cost ) + ( $minmen * $a3cost );
    if ( $totmen > $user['uCitizens'] ) {
        echo "You don't have enough citizens.";
    } elseif ( $thecost > $user['uGold'] ) {
        echo "You don't have enough gold.";
    } elseif ( $offmen < 0 || $defmen < 0 || $minmen < 0 || $totmen < 1 ) {
        echo "You must enter a proper amount.";
    } else {
        echo "You sucessfully trained $offmen offensive men, $defmen defensive men and $minmen miners for a price of $thecost gold.";
        $db->query( "UPDATE users SET uGold=uGold-$thecost,uOffensiveMen=uOffensiveMen+$offmen,uDefensiveMen=uDefensiveMen+$defmen,uMiners=uMiners+$minmen,uCitizens=uCitizens-$totmen WHERE uID='" . $user['uID'] . "'" );
    } 

    ?>
		<br><br>
		<a href="javascript:history.back();">BACK</a>
		</td>
	  </tr>
	</table>
	<?php
} elseif ( $_POST['untrain'] ) {

    ?>
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell3">Training</td>
	  </tr>
	  <tr>
		<td class="bodycell4">
		<center>
		<?php
    $offmen = round( str_replace( "-", "", $_POST['offmen'] ) );
    $defmen = round( str_replace( "-", "", $_POST['defmen'] ) );
    $minmen = round( str_replace( "-", "", $_POST['minmen'] ) );
    $totmen = $offmen + $defmen + $minmen;
    if ( $offmen < 0 || $defmen < 0 || $minmen < 0 || $totmen < 1 ) {
        echo "You must enter a proper amount.";
    } elseif ( $offmen > $user['uOffensiveMen'] ) {
        echo "You don't have that many offensive men to untrain.";
    } elseif ( $defmen > $user['uDefensiveMen'] ) {
        echo "You don't have that many defensive men to untrain.";
    } elseif ( $minmen > $user['uMiners'] ) {
        echo "You don't have that many miners to untrain.";
    } else {
        echo "You untrained $offmen offensive men, $defmen defensive men and $minmen miners.";
        $db->query( "UPDATE users SET uOffensiveMen=uOffensiveMen-$offmen,uDefensiveMen=uDefensiveMen-$defmen,uMiners=uMiners-$minmen,uCitizens=uCitizens+$totmen WHERE uID='" . $user['uID'] . "'" );
    } 

    ?>
		<br><br>
		<a href="javascript:history.back();">BACK</a>
		</center>
		</td>
	  </tr>
	</table>
	<?php
} 
require 'includes/footer.php';

?>