<?php

$ingame = "*";
require 'includes/header.php';

$column1 = "<b>Username</b><br>";
$column2 = "<b>Result</b><br>";
$column3 = "<b>Turns</b><br>";
$column4 = "<b>Gold</b><br>";
$column5 = "<b>EXP</b><br>";
$column6 = "<b>Time</b><br>";
$result = $db->query( "SELECT * FROM logs WHERE lType=1 AND lYou='" . $user['uID'] . "' ORDER BY lID DESC LIMIT 20" );
while ( $thelogs = $db->fetch( $result ) ) {
    $column1 .= "<a href=\"profile.php?id=" . $thelogs['lOther'] . "\">" . $thelogs['lOtherLogin'] . "</a><br>";
    if ( $thelogs['lWinLose'] == 1 ) {
        $column2 .= "You Won!<br>";
    } else {
        $column2 .= "You Lost!<br>";
    } 
    $column3 .= $thelogs['lTurns'] . "<br>";
    $column4 .= $thelogs['lGold'] . "<br>";
    $column5 .= $thelogs['lEXP'] . "<br>";
    $column6 .= $thelogs['lTime'] . "<br>";
} 

?>
        					<b><tl>Logs</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />		
<table width="600"  border="0">
  <tr>
	<td colspan="6" class="bodycell4" align="center"><br>Here are you attack and defense logs for the past 48 hours.<br><br></td>
  </tr>
  <tr>
	<td colspan="6" class="bodycell3"><b><tl>Defense Log (People Who Attacked You)</tl></b></td>
  </tr>
  <tr>
	<td class="bodycell4">
		<table width="100%" border="0">
		  <tr>
			<td width="20%" align="center">
			<?=$column1?>
			</td>
			<td width="15%" align="center">
			<?=$column2?>
			</td>
			<td width="10%" align="center">
			<?=$column3?>
			</td>
			<td width="15%" align="center">
			<?=$column4?>
			</td>
			<td width="15%" align="center">
			<?=$column5?>
			</td>
			<td width="25%" align="center">
			<?=$column6?>
			</td>
		  </tr>
		</table>
	</td>
  </tr>
<?php
$column1 = "<b>Username</b><br>";
$column2 = "<b>Result</b><br>";
$column3 = "<b>Turns</b><br>";
$column4 = "<b>Gold</b><br>";
$column5 = "<b>EXP</b><br>";
$column6 = "<b>Time</b><br>";
$result = $db->query( "SELECT * FROM logs WHERE lType=2 AND lYou='" . $user['uID'] . "' ORDER BY lID DESC LIMIT 20" );
while ( $thelogs = $db->fetch( $result ) ) {
    $column1 .= "<a href=\"profile.php?id=" . $thelogs['lOther'] . "\">" . $thelogs['lOtherLogin'] . "</a><br>";
    if ( $thelogs['lWinLose'] == 1 ) {
        $column2 .= "You Won!<br>";
    } else {
        $column2 .= "You Lost!<br>";
    } 
    $column3 .= $thelogs['lTurns'] . "<br>";
    $column4 .= $thelogs['lGold'] . "<br>";
    $column5 .= $thelogs['lEXP'] . "<br>";
    $column6 .= $thelogs['lTime'] . "<br>";
} 

?>
  <tr>
	<td colspan="6" class="bodycell3"><b><tl>Attack Log (People You Have Attacked)</tl></b></td>
  </tr>
  <tr>
	<td class="bodycell4">
		<table width="100%" border="0">
		  <tr>
			<td width="20%" align="center">
			<?=$column1?>
			</td>
			<td width="15%" align="center">
			<?=$column2?>
			</td>
			<td width="10%" align="center">
			<?=$column3?>
			</td>
			<td width="15%" align="center">
			<?=$column4?>
			</td>
			<td width="15%" align="center">
			<?=$column5?>
			</td>
			<td width="25%" align="center">
			<?=$column6?>
			</td>
		  </tr>
		</table>
	</td>
  </tr>
</table>

<?php
require 'includes/footer.php';

?>