<?php

$ingame = "*";
require 'includes/header.php';

$result = $db->query( "SELECT * FROM messages WHERE mTo='" . $user['uID'] . "' ORDER BY mID DESC" );
while ( $thepms = $db->fetch( $result ) ) {
    $column1 .= "<a href=\"profile.php?id=" . $thepms['mFrom'] . "\">" . $thepms['mFromLogin'] . "</a><br>";
    if ( $thepms[mRead] == "no" ) {
        $column2 .= "<i>[UNREAD]</i> ";
    } 
    $column2 .= "<a href=\"pm.php?msg=" . $thepms['mID'] . "\">" . $thepms['mTitle'] . "</a><br>";
    $column3 .= $thepms['mTime'] . "<br>";
} 
if ($_GET['mode']=='new') {
  ?>
   <b><tl>New PM</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<form action="pm.php" method="post">
	<table width="100%"  border="0">
	  <tr>
		<td width="30%" class="bodycell5" align="center">
		<b>Send To</b><br>(ID or Username)
		</td>
		<td width="70%" class="bodycell5" align="center">
		<input name="who" size="40" value="<?=$_GET['id']?>" type="text">
		</td>
	  </tr>
	  <tr>
		<td width="30%" class="bodycell5" align="center">
		<b>Title</b>
		</td>
		<td width="70%" class="bodycell4" align="center">
		<input name="title" size="40" maxlength="100" type="text">
		</td>
	  </tr>
	  <tr>
		<td width="20%" class="bodycell5" align="center">
		<b>Message</b>
		</td>
		<td width="70%" class="bodycell4" align="center">
		<textarea name="message" cols="50" rows="10" maxlength="5000"></textarea>
		</td>
	  </tr>
	  <tr>
		<td colspan="2" class="bodycell4" align="center">
		<input name="send" type="submit" value="Send">
		</td>
	  </tr>
	</table>
	</form>
	<?
} else
if ( !$_POST['send'] && !$_GET['msg'] && !$_POST['delete'] ) {
    ?>
    <b><tl>PM</tl></b><br />
    <div align="right"><a href="pm.php?mode=new"><img src="images/pm.png" border="0"></a></div>
	 <b><tl><img src="images/inbox.gif" border="0"> Inbox</tl></b>
	<table width="600"  border="0">
	  <tr>
		<td width="20%" class="bodycell4">
		<b>From</b>
		</td>
		<td width="55%" class="bodycell4">
		<b>Title</b>
		</td>
		<td width="25%" class="bodycell4" align="center">
		<b>Time</b>
		</td>
	  </tr>
	  <tr>
		<td width="20%" class="bodycell4">
		<?=$column1?>
		</td>
		<td width="55%" class="bodycell4">
		<?=$column2?>
		</td>
		<td width="25%" class="bodycell4" align="center">
		<?=$column3?>
		</td>
	  </tr>
	</table>
	<?php
} elseif ( $_POST['send'] ) {

    ?>
       <b><tl>Send Message</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell4" align="center">
		<?php
    $f_mto = htmlentities( stripslashes( $_POST['who'] ) );
    $result = $db->query( "SELECT uID FROM users WHERE uLogin=\"$f_mto\"" );
    $checkup = $db->fetch( $result );
    if ( !$checkup ) {
        $f_mto = round( $_POST['who'] );
        $result = $db->query( "SELECT uID FROM users WHERE uID=\"$f_mto\"" );
        $checkup = $db->fetch( $result );
    } else {
        $f_mto = $checkup['uID'];
    } 
    $f_mtitle = htmlentities( stripslashes( $_POST['title'] ) );
    $f_mbody = htmlentities( stripslashes( $_POST['message'] ) );
    $f_mtime = $gamedate;
    $f_mtime2 = time();
    if ( !$checkup ) {
        echo "This player does not exist.";
    } elseif ( !$f_mtitle ) {
        echo "Your message must have a title.";
    } elseif ( !$f_mbody ) {
        echo "Your message must have a body.";
    } else {
        $query = "INSERT INTO messages (`mTo`,`mFrom`,`mFromLogin`,`mTitle`,`mBody`,`mTime`,`mTime2`) VALUES ";
        $query .= "(\"$f_mto\",\"" . $user['uID'] . "\",\"" . $user['uLogin'] . "\",\"$f_mtitle\",\"$f_mbody\",\"$f_mtime\",\"$f_mtime2\")";
        $db->query( $query );
        echo "Your message has been sent.";
    } 

    ?>
		</td>
	  </tr>	
	</table>
	<?php
} elseif ( $_POST['delete'] ) {
    $theid = round( $_POST['msg'] );
    $result = $db->query( "SELECT * FROM messages WHERE mTo='" . $user['uID'] . "' AND mID='$theid'" );
    $thepm = $db->fetch( $result );

    ?>
       <b><tl>Delete Message</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell4" align="center">
		<?php
    if ( $thepm ) {
        echo "This message was successfully deleted.";
        $db->query( "DELETE FROM messages WHERE mTo='" . $user['uID'] . "' AND mID='$theid'" );
    } else {
        echo "This message does not exist.";
    } 

    ?>
		</td>
	  </tr>	
	</table>
	<?php
} elseif ( $_GET['msg'] ) {
    $theid = round( $_GET['msg'] );
    $result = $db->query( "SELECT * FROM messages WHERE mTo='" . $user['uID'] . "' AND mID='$theid'" );
    $thepm = $db->fetch( $result );

    ?>
       <b><tl>Message</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<table width="100%"  border="0">
	  <?php
    if ( $thepm ) {
        if ( $thepm[mRead] == "no" ) {
            $result = $db->query( "UPDATE messages SET mRead=\"yes\" WHERE mTo='" . $user['uID'] . "' AND mID='$theid'" );
        } 
             $thepm['mBody'] = str_replace("\n","<br />",$thepm['mBody']);
        ?>
		  <tr>
			<td class="bodycell4">
			<b>From:</b> <a href="profile.php?id=<?=$thepm['mFrom']?>"><?=$thepm['mFromLogin']?></a> (<b>Recieved:</b> <?=$thepm['mTime']?>)<br>
			<b>Title:</b> <?=$thepm['mTitle']?>
			</td>
		  </tr>
		  <tr>
			<td class="bodycell4">
			<?=$thepm['mBody']?>
			</td>
		  </tr>
		  <form action="pm.php" method="post">
		  <tr>
			<td class="bodycell4" align="center">
			<input name="msg" type="hidden" value="<?=$thepm['mID']?>">
			<input name="delete" type="submit" value="Delete">
			</td>
		  </tr>
		</table>
		</form>
		<form action="pm.php" method="post">
		<table width="100%"  border="0">
		  <tr>
			<td class="bodycell3">Reply</td>
		  </tr>
		  <tr>
			<td class="bodycell4" align="center">
			<input name="who" value="<?=$thepm['mFrom']?>" type="hidden">
			<input name="title" value="<? if (!eregi("RE:", $thepm['mTitle'])) { echo "RE:"; } ?> <?=$thepm['mTitle']?>" type="hidden">
			<textarea name="message" cols="50" rows="10" maxlength="5000"></textarea>
			</td>
		  </tr>
		  <tr>
			<td class="bodycell4" align="center">
			<input name="send" type="submit" value="Reply">
			</td>
		  </tr>
		  </form>
		  <?php
    } else {

        ?>
		  <tr>
			<td class="bodycell4" align="center">
			This message does not exist.
			</td>
		  </tr>
		  <?php
    } 

    ?>
	</table>
	<?php
} 
require 'includes/footer.php';

?>