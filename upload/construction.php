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
$plant_cost = (30000+($user['uPlants']*3000));
$plant_cost = $plant_cost - ( ( $plant_cost / 100 ) * $discount );

$plant_refund = ((30000+($user['uPlants']*3000))/2.5);
$plant_refund = $plant_refund - ( ( $plant_refund / 100 ) * $discount );

if ( !$_POST[Build] && !$_POST[Demolish] ) {

    ?>
    					<b><tl>Construction</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<form action="construction.php" method="post">
	<table width="500"  border="0">
	  <tr>
		<td colspan="4" class="bodycell4">
			<center>
			You have <?=$user['uGold']?> Gold to spend.
			</center>
		</td>
	  </tr>
	  <tr>
		<td class="bodycell4" width="100%">
		<table width="100%"><tr><td><b>Type</b></td><td align="center"><b>You Have</b></td><td align="center"><b>Refund</b></td><td align="center"><b>Cost</b></td><td><b>Number of units</b></td></tr>
		<tr><td>Power Plant</td><td align="center"><?=$user['uPlants']?></td><td align="center"><?=$plant_refund?></td><td align="center"><?=$plant_cost?></td><td><input name="numplants" type="text" value="0" size="5" maxlength="5"></td></tr>
		</table>			
		</td>
	  </tr>
	  <tr>
		<td colspan="4" class="bodycell4">
			<center>
			<input name="Build" type="submit" value="Build">
			<input name="Demolish" type="submit" value="Demolish">
			</center>
		</td>
	  </tr>
	</table>
	</form>
	<?php
} elseif ( $_POST['Build'] ) {

    ?>
        					<b><tl>Construction</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell4" align="center">
		<?php
    $plants = round( str_replace( "-", "", $_POST['numplants'] ) );
    $thecost = ( $plants * $plant_cost );
	if ( $thecost > $user['uGold'] ) {
        echo "You don't have enough gold.";
    } elseif ( $plants  < 1) {
        echo "You must enter a proper amount.";
    } else {
        echo "You sucessfully builded $plants Power Plants for a price of $thecost gold.";
        $db->query( "UPDATE users SET uGold=uGold-$thecost,uPlants=uPlants+$plants WHERE uID='" . $user['uID'] . "'" );
    } 

    ?>
		<br><br>
		<a href="javascript:history.back();">BACK</a>
		</td>
	  </tr>
	</table>
	<?php
} elseif ( $_POST['Demolish'] ) {

    ?>
        					<b><tl>Construction</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell4">
		<center>
		<?php
   $plants = round( str_replace( "-", "", $_POST['numplants'] ) );
    $thecost = ( $plants * $plant_refund );
    if ( $plants < 1 ) {
        echo "You must enter a proper amount.";
    } elseif ( $plants > $user['uPlants'] ) {
        echo "You don't have that many Power Plants Demolish.";
    }  else {
        echo "You Demolished $plants Power Plants and got a refund of $thecost.";
        $db->query( "UPDATE users SET uPlants=uPlants-$plants,uGold=uGold+$thecost WHERE uID='" . $user['uID'] . "'" );
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