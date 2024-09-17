<?php

$ingame = "*";
require 'includes/header.php';

if ( $user['uMineLevel'] == 1 ) {
    $price = 2500000;
} elseif ( $user['uMineLevel'] == 2 ) {
    $price = 7500000;
} elseif ( $user['uMineLevel'] == 3 ) {
    $price = 22500000;
} elseif ( $user['uMineLevel'] == 4 ) {
    $price = 67500000;
} elseif ( $user['uMineLevel'] == 5 ) {
    $price = "-";
    $isupgrades = 1;
} 
if ( $user['uMineLevel'] != 5 ) {
    $nextlevel = $user['uMineLevel'] + 1;
} 
if ( !$_POST['mine'] ) {
    if ( !$isupgrades ) {

        ?>
		<form action="upgrade.php" method="post">
		<?php
    } 

    ?>
    					<b><tl>Upgrades</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<table width="500"  border="0">
	  <tr>
		<td class="bodycell5" align="center" width="30%">
		<b>Mine Level</b>
		</td>
		<td class="bodycell5" align="center" width="40%">
		<?=$price?>
		</td>
		<td class="bodycell5" align="center" width="30%">
		<?php
    if ( $user['uMineLevel'] != 5 ) {

        ?>
			<input name="mine" type="submit" value="Upgrade to Level <?=$nextlevel?>">
			<?php
    } else {
        echo "-";
    } 

    ?>
		</td>
	  </tr>
	</table>
	<?php
    if ( !$isupgrades ) {

        ?>
		</form>
		<?php
    } 
} elseif ( $_POST['mine'] ) {

    ?>
    					<b><tl>Bank</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell4" align="center">
		<?php
    if ( $nextlevel == "-" ) {
        echo "There are no further upgrades for this.";
    } elseif ( $price > $user['uGold'] ) {
        echo "You don't have enough gold to upgrade.";
    } else {
        echo "You successfully upgraded your Mine Level.";
        $db->query( "UPDATE users SET uGold=uGold-$price,uMineLevel=$nextlevel WHERE uID='" . $user['uID'] . "'" );
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