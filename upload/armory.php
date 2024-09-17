<?php

$ingame = "*";
require 'includes/header.php';

/* DISCOUNTS DISABLED
if ( $user[uType] == 3 ) {
    $discount = 5;
} 
if ( $user[uType] == 4 ) {
    $discount = 10;
}
*/ 
$w1cost = $SETTINGS['wp_1_cst'] - ( ( $SETTINGS['wp_1_cst'] / 100 ) * $discount );
$w2cost = $SETTINGS['wp_2_cst'] - ( ( $SETTINGS['wp_2_cst'] / 100 ) * $discount );
$w3cost = $SETTINGS['wp_3_cst'] - ( ( $SETTINGS['wp_3_cst'] / 100 ) * $discount );
$w4cost = $SETTINGS['wp_4_cst'] - ( ( $SETTINGS['wp_4_cst'] / 100 ) * $discount );
$w5cost = $SETTINGS['wp_5_cst'] - ( ( $SETTINGS['wp_5_cst'] / 100 ) * $discount );

$a1cost = $SETTINGS['ar_1_cst'] - ( ( $SETTINGS['ar_1_cst'] / 100 ) * $discount );
$a2cost = $SETTINGS['ar_2_cst'] - ( ( $SETTINGS['ar_2_cst'] / 100 ) * $discount );
$a3cost = $SETTINGS['ar_3_cst'] - ( ( $SETTINGS['ar_3_cst'] / 100 ) * $discount );
$a4cost = $SETTINGS['ar_4_cst'] - ( ( $SETTINGS['ar_4_cst'] / 100 ) * $discount );
$a5cost = $SETTINGS['ar_5_cst'] - ( ( $SETTINGS['ar_5_cst'] / 100 ) * $discount );

if ( !$_POST[buy_arm] && !$_POST[sell_arm] && !$_POST[buy_wea] && !$_POST[sell_wea] ) {

    ?>
        					<b><tl>Armory</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<table width="100%"  border="0">
	  <tr>
		<td colspan="6" class="bodycell4">
			<center>
			You have <?=$user[uGold]?> gold available to spend.<br><br>
			You can buy as many weapons and armour as you like, but each army member may only use 1 item!
			</center>
		</td>
	  </tr>
	</table>
	<b><tl>Weapons (Offense)</tl></b>
	<form action="armory.php" method="post">
	<table width="660"  border="0">
	  <tr>
		<td class="bodycell5" width="20%" valign="top">
			<b>Name:</b><br>
			<?=$SETTINGS['wp_1_nm']?><br><br>
			<?=$SETTINGS['wp_2_nm']?><br><br>
			<?=$SETTINGS['wp_3_nm']?><br><br>
			<?=$SETTINGS['wp_4_nm']?><br><br>
			<?=$SETTINGS['wp_5_nm']?>
		</td>
		<td class="bodycell5" width="15%" align="center" valign="top">
			<b>You Have:</b><br>
			<?=$user['uWeapon1']?><br><br>
			<?=$user['uWeapon2']?><br><br>
			<?=$user['uWeapon3']?><br><br>
			<?=$user['uWeapon4']?><br><br>
			<?=$user['uWeapon5']?>
		</td>
		<td class="bodycell5" width="15%" align="center" valign="top">
			<b>Cost:</b><br>
			<?=$w1cost?><br><br>
			<?=$w2cost?><br><br>
			<?=$w3cost?><br><br>
			<?=$w4cost?><br><br>
			<?=$w5cost?>
		</td>
		<td class="bodycell5" width="20%" align="center" valign="top">
			<b>Sell Price:</b><br>
			<?=$SETTINGS['wp_1_sll']?><br><br>
			<?=$SETTINGS['wp_2_sll']?><br><br>
			<?=$SETTINGS['wp_3_sll']?><br><br>
			<?=$SETTINGS['wp_4_sll']?><br><br>
			<?=$SETTINGS['wp_5_sll']?>
		</td>
		<td class="bodycell5" width="15%" align="center" valign="top">
			<b>Stats:</b><br>
			+<?=$SETTINGS['wp_1_dmg']?> Offense<br><br>
			+<?=$SETTINGS['wp_2_dmg']?> Offense<br><br>
			+<?=$SETTINGS['wp_3_dmg']?> Offense<br><br>
			+<?=$SETTINGS['wp_4_dmg']?> Offense<br><br>
			+<?=$SETTINGS['wp_5_dmg']?> Offense
		</td>
		<td class="bodycell4" width="25%" align="center" valign="top">
			<b>Buy / Sell:</b><br>
			<input name="weap1" type="text" value="0" size="5" maxlength="5"><br>
			<input name="weap2" type="text" value="0" size="5" maxlength="5"><br>
			<input name="weap3" type="text" value="0" size="5" maxlength="5"><br>
			<input name="weap4" type="text" value="0" size="5" maxlength="5"><br><br />
			<input name="weap5" type="text" value="0" size="5" maxlength="5">
		</td>
	  </tr>
	  <tr>
		<td colspan="6" class="bodycell4">
			<center>
			<input name="buy_wea" type="submit" value="Buy">
			<input name="sell_wea" type="submit" value="Sell">
			</center>
		</td>
	  </tr>
	</table>
	</form>
		<b><tl>Armour (Defense)</tl></b><b></b>
	<form action="armory.php" method="post">
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell5" width="20%" valign="top">
			<b>Name:</b><br>
			<?=$SETTINGS['ar_1_nm']?><br><br>
			<?=$SETTINGS['ar_2_nm']?><br><br>
			<?=$SETTINGS['ar_3_nm']?><br><br>
			<?=$SETTINGS['ar_4_nm']?><br><br>
			<?=$SETTINGS['ar_5_nm']?>
		</td>
		<td class="bodycell5" width="15%" align="center" valign="top">
			<b>You Have:</b><br>
			<?=$user['uArmour1']?><br><br>
			<?=$user['uArmour2']?><br><br>
			<?=$user['uArmour3']?><br><br>
			<?=$user['uArmour4']?><br><br>
			<?=$user['uArmour5']?>
		</td>
		<td class="bodycell5" width="15%" align="center" valign="top">
			<b>Cost:</b><br>
			<?=$a1cost?><br><br>
			<?=$a2cost?><br><br>
			<?=$a3cost?><br><br>
			<?=$a4cost?><br><br>
			<?=$a5cost?>
		</td>
		<td class="bodycell5" width="20%" align="center" valign="top">
			<b>Sell Price:</b><br>
			<?=$SETTINGS['ar_1_sll']?><br><br>
			<?=$SETTINGS['ar_2_sll']?><br><br>
			<?=$SETTINGS['ar_3_sll']?><br><br>
			<?=$SETTINGS['ar_4_sll']?><br><br>
			<?=$SETTINGS['ar_5_sll']?>
		</td>
		<td class="bodycell5" width="15%" align="center" valign="top">
			<b>Stats:</b><br>
			+<?=$SETTINGS['ar_1_dmg']?> Defense<br><br>
			+<?=$SETTINGS['ar_2_dmg']?> Defense<br><br>
			+<?=$SETTINGS['ar_3_dmg']?> Defense<br><br>
			+<?=$SETTINGS['ar_4_dmg']?> Defense<br><br>
			+<?=$SETTINGS['ar_5_dmg']?> Defense
		</td>
		<td class="bodycell4" width="25%" align="center" valign="top">
			<b>Buy / Sell:</b><br>
			<input name="arm1" type="text" value="0" size="5" maxlength="5"><br>
			<input name="arm2" type="text" value="0" size="5" maxlength="5"><br>
			<input name="arm3" type="text" value="0" size="5" maxlength="5"><br>
			<input name="arm4" type="text" value="0" size="5" maxlength="5"><br><br />
			<input name="arm5" type="text" value="0" size="5" maxlength="5">
		</td>
	  </tr>
	  <tr>
		<td colspan="6" class="bodycell4">
			<center>
			<input name="buy_arm" type="submit" value="Buy">
			<input name="sell_arm" type="submit" value="Sell">
			</center>
		</td>
	  </tr>
	</table>
	</form>
	<?php
} elseif ( $_POST['buy_arm'] ) {

    ?>
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell3">Armory</td>
	  </tr>
	  <tr>
		<td class="bodycell4" align="center">
		<?php
    $arm1 = round( str_replace( "-", "", $_POST['arm1'] ) );
    $arm2 = round( str_replace( "-", "", $_POST['arm2'] ) );
    $arm3 = round( str_replace( "-", "", $_POST['arm3'] ) );
    $arm4 = round( str_replace( "-", "", $_POST['arm4'] ) );
    $arm5 = round( str_replace( "-", "", $_POST['arm5'] ) );
    $thetotal = $arm1 + $arm2 + $arm3 + $arm4 + $arm5;
    $thecost = ( $arm1 * $a1cost ) + ( $arm2 * $a2cost ) + ( $arm3 * $a3cost ) + ( $arm4 * $a4cost ) + ( $arm5 * $a5cost );
    if ( $thecost > $user['uGold'] ) {
        echo "You don't have enough gold.";
    } elseif ( $arm1 < 0 || $arm2 < 0 || $arm3 < 0 || $arm4 < 0 || $arm5 < 0 || $thetotal < 1 ) {
        echo "You must enter a proper amount.";
    } else {
        echo "You bought $thetotal armour for a price of $thecost gold.";
        $db->query( "UPDATE users SET uGold=uGold-$thecost,uArmour1=uArmour1+$arm1,uArmour2=uArmour2+$arm2,uArmour3=uArmour3+$arm3,uArmour4=uArmour4+$arm4,uArmour5=uArmour5+$arm5 WHERE uID='" . $user['uID'] . "'" );
    } 

    ?>
		<br><br>
		<a href="javascript:history.back();">BACK</a>
		</td>
	  </tr>
	</table>
	<?php
} elseif ( $_POST['sell_arm'] ) {

    ?>
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell3">Armory</td>
	  </tr>
	  <tr>
		<td class="bodycell4" align="center">
		<?php
    $arm1 = round( str_replace( "-", "", $_POST['arm1'] ) );
    $arm2 = round( str_replace( "-", "", $_POST['arm2'] ) );
    $arm3 = round( str_replace( "-", "", $_POST['arm3'] ) );
    $arm4 = round( str_replace( "-", "", $_POST['arm4'] ) );
    $arm5 = round( str_replace( "-", "", $_POST['arm5'] ) );
    $thetotal = $arm1 + $arm2 + $arm3 + $arm4 + $arm5;
    $thecost = ( $arm1 * $SETTINGS['ar_1_sll'] ) + ( $arm2 * $SETTINGS['ar_2_sll'] ) + ( $arm3 * $SETTINGS['ar_3_sll'] ) + ( $arm4 * $SETTINGS['ar_4_sll'] ) + ( $arm5 * $SETTINGS['ar_5_sll'] );
    if ( $arm1 > $user['uArmour1'] ) {
        echo "You don't have that many " . $SETTINGS['ar_1_nm'] . " to sell.";
    } elseif ( $arm2 > $user['uArmour2'] ) {
        echo "You don't have that many " . $SETTINGS['ar_2_nm'] . " to sell.";
    } elseif ( $arm3 > $user['uArmour3'] ) {
        echo "You don't have that many " . $SETTINGS['ar_3_nm'] . " to sell.";
    } elseif ( $arm4 > $user['uArmour4'] ) {
        echo "You don't have that many " . $SETTINGS['ar_4_nm'] . " to sell.";
    } elseif ( $arm5 > $user['uArmour5'] ) {
        echo "You don't have that many " . $SETTINGS['ar_5_nm'] . " to sell.";
    } elseif ( $thetotal < 1 || $arm1 < 0 || $arm2 < 0 || $arm3 < 0 || $arm4 < 0 || $arm5 < 0 ) {
        echo "You must enter a proper amount.";
    } else {
        echo "You sold $thetotal armour for a price of $thecost gold.";
        $db->query( "UPDATE users SET uGold=uGold+$thecost,uArmour1=uArmour1-$arm1,uArmour2=uArmour2-$arm2,uArmour3=uArmour3-$arm3,uArmour4=uArmour4-$arm4,uArmour5=uArmour5-$arm5 WHERE uID='" . $user['uID'] . "'" );
    } 

    ?>
		<br><br>
		<a href="javascript:history.back();">BACK</a>
		</td>
	  </tr>
	</table>
	<?php
} elseif ( $_POST['buy_wea'] ) {

    ?>
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell3">Armory</td>
	  </tr>
	  <tr>
		<td class="bodycell4" align="center">
		<?php
    $arm1 = round( str_replace( "-", "", $_POST['weap1'] ) );
    $arm2 = round( str_replace( "-", "", $_POST['weap2'] ) );
    $arm3 = round( str_replace( "-", "", $_POST['weap3'] ) );
    $arm4 = round( str_replace( "-", "", $_POST['weap4'] ) );
    $arm5 = round( str_replace( "-", "", $_POST['weap5'] ) );
    $thetotal = $arm1 + $arm2 + $arm3 + $arm4 + $arm5;
    $thecost = ( $arm1 * $a1cost ) + ( $arm2 * $a2cost ) + ( $arm3 * $a3cost ) + ( $arm4 * $a4cost ) + ( $arm5 * $a5cost );
    if ( $thecost > $user['uGold'] ) {
        echo "You don't have enough gold.";
    } elseif ( $arm1 < 0 || $arm2 < 0 || $arm3 < 0 || $arm4 < 0 || $arm5 < 0 || $thetotal < 1 ) {
        echo "You must enter a proper amount.";
    } else {
        echo "You bought $thetotal weapons for a price of $thecost gold.";
        $db->query( "UPDATE users SET uGold=uGold-$thecost,uWeapon1=uWeapon1+$arm1,uWeapon2=uWeapon2+$arm2,uWeapon3=uWeapon3+$arm3,uWeapon4=uWeapon4+$arm4,uWeapon5=uWeapon5+$arm5 WHERE uID='" . $user['uID'] . "'" );
    } 

    ?>
		<br><br>
		<a href="javascript:history.back();">BACK</a>
		</td>
	  </tr>
	</table>
	<?php
} elseif ( $_POST['sell_wea'] ) {

    ?>
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell3">Armory</td>
	  </tr>
	  <tr>
		<td class="bodycell4" align="center">
		<?php
    $arm1 = round( str_replace( "-", "", $_POST['weap1'] ) );
    $arm2 = round( str_replace( "-", "", $_POST['weap2'] ) );
    $arm3 = round( str_replace( "-", "", $_POST['weap3'] ) );
    $arm4 = round( str_replace( "-", "", $_POST['weap4'] ) );
    $arm5 = round( str_replace( "-", "", $_POST['weap5'] ) );
    $thetotal = $arm1 + $arm2 + $arm3 + $arm4 + $arm5;
    $thecost = ( $arm1 * $SETTINGS['wp_1_sll'] ) + ( $arm2 * $SETTINGS['wp_2_sll'] ) + ( $arm3 * $SETTINGS['wp_3_sll'] ) + ( $arm4 * $SETTINGS['wp_4_sll'] ) + ( $arm5 * $SETTINGS['wp_5_sll'] );
    if ( $arm1 > $user['uWeapon1'] ) {
        echo "You don't have that many $SETTINGS[wp_1_sll] to sell.";
    } elseif ( $arm2 > $user['uWeapon2'] ) {
        echo "You don't have that many $SETTINGS[wp_2_sll] to sell.";
    } elseif ( $arm3 > $user['uWeapon3'] ) {
        echo "You don't have that many $SETTINGS[wp_3_sll] to sell.";
    } elseif ( $arm4 > $user['uWeapon4'] ) {
        echo "You don't have that many $SETTINGS[wp_4_sll] to sell.";
    } elseif ( $arm5 > $user['uWeapon5'] ) {
        echo "You don't have that many $SETTINGS[wp_5_sll] to sell.";
    } elseif ( $thetotal < 1 || $arm1 < 0 || $arm2 < 0 || $arm3 < 0 || $arm4 < 0 || $arm5 < 0 ) {
        echo "You must enter a proper amount.";
    } else {
        echo "You sold $thetotal weapons for a price of $thecost gold.";
        $db->query( "UPDATE users SET uGold=uGold+$thecost,uWeapon1=uWeapon1-$arm1,uWeapon2=uWeapon2-$arm2,uWeapon3=uWeapon3-$arm3,uWeapon4=uWeapon4-$arm4,uWeapon5=uWeapon5-$arm5 WHERE uID='" . $user['uID'] . "'" );
    } 

    ?>
		<br><br>
		<a href="javascript:history.back();">BACK</a>
		</td>
	  </tr>
	</table>
	<?php
} 
require 'includes/footer.php';

?>