<?php
$ingame = "*";
require 'includes/header.php';
if ( !$_POST['deposit'] && !$_POST['withdraw'] ) {

    ?>
        					<b><tl>Bank</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<form action="bank.php" method="post">
	<table width="500"  border="0">
	  <tr>
		<td colspan="2" class="bodycell4">
			<center>
			Deposits: <?=$user['uDeposits']?> / <?=$user['uDepositsMax']?><br>
			Interest Rate: <?=$user['uInterestRate']?>%<br>
			Interest: <?=floor( ( ( $user['uBank'] + 1 ) / 100 ) * $user['uInterestRate'] )?> gold a day
			</center>
		</td>
	  </tr>
	  <tr>
		<td class="bodycell4" width="50%" align="center">
			<b>Deposit:</b><br><br>
			<input name="money1" type="text" value="0" size="5" maxlength="10"> / <?=$user['uGold']?><br><br>
			<input name="deposit" type="submit" value="Deposit">
		</td>
		<td class="bodycell4" width="50%" align="center">
			<b>Withdraw:</b><br><br>
			<input name="money2" type="text" value="0" size="5" maxlength="10"> / <?=$user['uBank']?><br><br>
			<input name="withdraw" type="submit" value="Withdraw">
		</td>
	  </tr>
	</table>
	</form>
	<?php
} elseif ( $_POST['deposit'] ) {

    ?>
        					<b><tl>Bank</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<table width="500"  border="0">
	  <tr>
		<td class="bodycell4" align="center">
		<?php
    $moneys = round( str_replace( "-", "", $_POST['money1'] ) );
    if ( $moneys > $user['uGold'] ) {
        echo "You don't have enough gold.";
    } elseif ( $moneys < 1 ) {
        echo "You must enter a proper amount.";
    } elseif ( $user['uDeposits'] == 0 ) {
        echo "You can't deposit any more for today.";
    } else {
        echo "You sucessfully deposited $moneys gold.";
        $db->query( "UPDATE users SET uGold=uGold-$moneys,uBank=uBank+$moneys,uDeposits=uDeposits-1 WHERE uID='" . $user['uID'] . "'" );
    } 

    ?>
		<br><br>
		<a href="javascript:history.back();">BACK</a>
		</td>
	  </tr>
	</table>
	<?php
} elseif ( $_POST['withdraw'] ) {

    ?>
        					<b><tl>Bank</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<table width="500"  border="0">
	  <tr>
		<td class="bodycell4" align="center">
		<?php
    $moneys = round( str_replace( "-", "", $_POST['money2'] ) );
    if ( $moneys > $user['uBank'] ) {
        echo "You don't have enough gold in your bank.";
    } elseif ( $moneys < 1 ) {
        echo "You must enter a proper amount.";
    } else {
        echo "You sucessfully withdrew $moneys gold.";
        $db->query( "UPDATE users SET uGold=uGold+$moneys,uBank=uBank-$moneys WHERE uID='" . $user['uID'] . "'" );
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