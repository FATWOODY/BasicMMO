<?php

$ingame = "*";
require 'includes/header.php';

$theid = round( $_GET['id'] );

$result = $db->query( "SELECT * FROM users WHERE uID=\"$theid\"" );
$checkup = $db->fetch( $result );

?>
					<b><tl><?=$checkup['uLogin']?>'s Profile</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
<table width="600"  border="0">
  <tr>
	<td class="bodycell4" width="50%" valign="top">
		<?php
		$checkup['uProfile'] = str_replace("\n","<br />",$checkup['uProfile']);
if ( !$checkup['uProfile'] ) {
    echo "There is no profile available for $checkup[uLogin].";
} else {
    echo $checkup['uProfile'];
} 

?>
	</td>
	<td class="bodycell4" width="50%" valign="top">
		<div class="smlhead"><b><tl>Actions</tl></b></div><br>
		<center>
		<a href="attack.php?id=<?=$checkup['uID']?>">Attack <?=$checkup['uLogin']?></a><br><br>
		<a href="pm.php?mode=new&id=<?=$checkup['uID']?>">Send <?=$checkup['uLogin']?> A Message</a><br>
		</center>
		<br><br>
		<div class="smlhead"><b><tl>Stats</tl></b></div><br>		
		<table width="100%" border="0">
		  <tr>
			<td width="50%">
			<b>Race<br>
			Rank<br>
			Gold<br>
			Population<br>
			Army Size<br>
			Level<br></b>
			</td>
			<td width="50%">
			<?php
if ( $checkup['uRace'] == 1 ) {
    echo $SETTINGS['prace_1'];
} elseif ( $checkup['uRace'] == 2 ) {
    echo $SETTINGS['prace_2'];
} elseif ( $checkup['uRace'] == 3 ) {
    echo $SETTINGS['prace_3'];
} elseif ( $checkup['uRace'] == 4 ) {
    echo $SETTINGS['prace_4'];
} elseif ( $checkup['uRace'] == 5 ) {
    echo $SETTINGS['prace_5'];
} elseif ( $checkup['uRace'] == 6 ) {
    echo $SETTINGS['prace_6'];
} 
echo "<br>";
if ( $checkup['uType'] == 2 && $checkup['uRank'] != 5 ) {
    echo "Bronze ";
} elseif ( $checkup['uType'] == 3 && $checkup['uRank'] != 5 ) {
    echo "Silver ";
} elseif ( $checkup['uType'] == 4 && $checkup['uRank'] != 5 ) {
    echo "Gold ";
} 
if ( $checkup['uRank'] == 1 ) {
    echo "Member";
} elseif ( $checkup['uRank'] == 3 ) {
    echo "Moderator";
} elseif ( $checkup['uRank'] == 4 ) {
    echo "Admin";
} elseif ( $checkup['uRank'] == 5 ) {
    echo "Owner";
} 

?><br>
			<?=$checkup['uGold']?><br>
			<?=$checkup['uCitizens'] + $checkup['uOffensiveMen'] + $checkup['uDefensiveMen'] + $checkup['uMiners']?><br>
			<?=$checkup['uOffensiveMen'] + $checkup['uDefensiveMen']?><br>
			<?=$checkup['uLevel']?><br>
			</td>
		  </tr>
		</table>
	</td>
  </tr>
</table>

<?php
require 'includes/footer.php';

?>