<?php

$query = "SELECT uID,uLastPoll FROM polls_votes WHERE uID=\"" . $user['uID'] . "\"";
$result = $db->query( $query );
$user2 = $db->fetch( $result );

function make_bar( $percent )
{
    $percentleft = 100 - $percent;

    ?>
	<table width="100%" height="7px" cellspacing="0" class="percentbar">
	  <tr>
		  <?php if ( $percent > 0 ) {
        ?>
		  	<td width="<?=$percent?>%" class="pbgreen"> </td>
		  <?php } 
    if ( $percentleft > 0 ) {
        ?>
		  	<td width="<?=$percentleft?>%" class="pbred"> </td>
		  <?php } 
    ?>
	  </tr>
	</table>
	<?php
} 

$theid = floor( $_POST['pid'] );
if ( $theid ) {
    $query = "SELECT * FROM polls WHERE pID=$theid";
} else {
    $query = "SELECT * FROM polls ORDER BY pID DESC LIMIT 1";
} 
$result = $db->query( $query );
$polls = $db->fetch( $result );

if ( $_GET['stp'] == "v" && $_POST['thevote'] && $user2['uLastPoll'] < $polls['pID'] ) {
    $count = 0;
    $ExplodeIt = explode( ";", "$polls[pResults]" );
    foreach( $ExplodeIt as $results ) {
        $count++;
        if ( $count != 1 ) {
            $delimeterthing = ";";
        } 
        if ( $count == $_POST['thevote'] ) {
            $newtotal = $results + 1;
        } else {
            $newtotal = $results;
        } 
        $theresults .= "$delimeterthing$newtotal";
    } 
    $result = $db->query( "UPDATE polls SET pResults=\"$theresults\" WHERE pID='" . $polls['pID'] . "'" );
    if ( $user2 ) {
        $result = $db->query( "UPDATE polls_votes SET uLastPoll=\"" . $polls['pID'] . "\" WHERE uID='" . $user2['uID'] . "'" );
    } else {
        $result = $db->query( "INSERT INTO polls_votes (`uID`,`uLastPoll`) VALUES (\"" . $user['uID'] . "\",\"" . $polls['pID'] . "\")" );
    } 
    $polls['pResults'] = $theresults;
    $user2['uLastPoll'] = $polls['pID'];
    $justvote = $_POST['thevote'];
} 

$eltext = "The latest Poll Question is... ";

?>
<div class="polltext">
<B><?=$eltext?></B><BR><br />
<?=stripslashes( html_entity_decode( $polls['pQuestion'] ) )?><BR>
<?php
if ( $user2['uLastPoll'] < $polls['pID'] ) {

    ?>
	<form method="POST" action="news.php?stp=v">
	<?php
    $qcount = 0;
    $ExplodeIt = explode( ";", $polls['pAnswers'] );
    foreach( $ExplodeIt as $questions ) {
        $qcount++;

        ?>
		<div class="polltext"><input type="radio" name="thevote" value="<?=$qcount?>" class"chkbox"> <?=stripslashes( html_entity_decode( $questions ) )?></div>
		<?php
    } 

    ?>
	<BR><input type="submit" value="Submit Vote!">
	</form>
	<?php
} else {
    $total = 0;
    $count = 0;
    $ExplodeIt = explode( ";", $polls['pResults'] );
    foreach( $ExplodeIt as $results ) {
        $count++;
        $total += $results;
        $rarray[$count] = $results;
    } 

    echo "<BR>";

    $rcount = 0;
    $ExplodeIt = explode( ";", $polls['pAnswers'] );
    foreach( $ExplodeIt as $results ) {
        $rcount++;
        if ( $rarray[$rcount] == 0 ) {
            $percent = 0;
        } else {
            $percent = round( $rarray[$rcount] / $total * 100 );
        } 

        ?>
		<B><?=$rcount?>.</B> <?=stripslashes( html_entity_decode( $results ) )?> - <?=$rarray[$rcount]?> Votes<BR>
		<table border="0" width="150" height="15" cellspacing="0" cellpadding="0">
		  <tr>
		    <td width="100%">
		    <?=make_bar( $percent )?>
		    </td>
		  </tr>
		</table>
		<?php
    } 

    ?>
	<BR>
	Total Votes: <?=$total?>
	<?php
} 

?>
</div>