<?php

$ingame = "*";
require 'includes/header.php';

$forums = array( 1 => 'General Discussion',
    2 => 'Fun Board',
    3 => 'Artwork',
    4 => 'Game Help',
	5 => 'Game Requests' );
$forums_discription = array( 1 => 'Talk about anything.',
    2 => 'Got a joke or a funny prank to tell? Post it here.',
    3 => 'Artwork made for the game.',
    4 => 'Get help from other players here.',
	5 => 'Got a feature that you think should be in the game or have an improvement idea? Post it here.' );

function thread_children( $postid )
{
    $result = mysql_query( "SELECT mID FROM forum_messages WHERE mBelong='$postid'" );
    while ( $mbtopics = mysql_fetch_array( $result ) ) {
        $childrenz .= "," . $mbtopics['mID'] . thread_children( $mbtopics['mID'] );
    } 
    return $childrenz;
} 
if ( $_GET['clp'] ) {
    function delete_thread( $parentn )
    {
        $result = mysql_query( "SELECT * FROM forum_messages WHERE mID=\"" . $_GET['clp'] . "\"" );
        $mbtopic = mysql_fetch_array( $result );
        $delids = $_GET['clp'] . thread_children( $_GET['clp'] );
        $result = mysql_query( "DELETE FROM forum_messages WHERE mID in ($delids)" );
        $result = mysql_query( "UPDATE forum_messages SET mChildren=mChildren-1 WHERE mID=\"" . $mbtopic['mBelong'] . "\"" );
    } 
    if ( $ALLOWED_ACTIONS['forums'] ) {
        delete_thread( floor( $_GET['clp'] ) );
    } 
} 

if ( $_GET['forum'] ) {
    $x = floor( $_GET['forum'] );
    $xtratitle = " - <i>$forums[$x]</i>";
} elseif ( $_GET['stp'] == 'postm' ) {
    $xtratitle = ' - Post Message';
} elseif ( $_GET['topic'] ) {
    $x = floor( $_GET['topic'] );
    $result = $db->query( "SELECT * FROM forum_messages WHERE mID=\"$x\"" );
    $mbtopic = $db->fetch( $result );
    $xtratitle = " - <i>" . $mbtopic['mSubject'] . "</i>";
} 
?>
   <b><tl>Forums<?=$xtratitle?></tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
<table width="100%"  border="0">
  <tr>
	<td class="bodycell4">
	<?php
if ( !$_GET['stp'] && !$_GET['forum'] && !$_GET['topic'] ) {

    ?>
		<p><table width="600" border="0"><tr><td><b>Message Board Rules</b></td><td width="45%"><b>Consequences after warning</b></td></tr>
		<tr><td>No Flooding or spamming</td><td>Account Deletion</td></tr>
		<tr><td>No Racism or harmful comments</td><td>Account Reset</td></tr>
		<tr><td>Do not post your or anyone elses account information</td><td>Gold Deduction</td></tr>
		<tr><td>Use punctuation where necessary and do not post in ALL CAPS</td><td>Disrespect</td></tr>
		</table>
		
		</td></tr>
		<tr><td class="bodycell4">
		
		<table border="0" width="95%">
		  <tr>
			<td width="70%" align="center"><B>Forum</B></td>
			<td width="15%" align="center"><B>Topics</B></td>
			<td width="10%" align="center"><B>Replies</B></td>
			<td width="5%"></td>
		  </tr>
			<?php
    foreach( $forums as $bid => $bname ) {
        $result = $db->query( "SELECT count(*) FROM forum_messages WHERE mBelong=0 AND mThread=$bid" );
        $mbtopics = $db->fetch( $result );
        $topicsnum = $mbtopics[0];

        $result = $db->query( "SELECT count(*) FROM forum_messages WHERE mThread=$bid" );
        $mbtopics = $db->fetch( $result );
        $postsnum = $mbtopics[0] - $topicsnum;

        ?>
				<tr>
					<td width="70%"><a href="forums.php?forum=<?=$bid?>"><?=$bname?><br /></a><?=$forums_discription[$bid]; ?></td>
					<td width="15%" align="center"><?=$topicsnum?></td>
					<td width="10%" align="center"><?=$postsnum?></td>
					<td width="5%">
					</td>
				</tr>
				<tr><td colspan="3"><hr></td></tr>
				<?php
    } 

    ?>
		</table>
		<br><br>
		<?php
} elseif ( $_GET['forum'] ) {
  if ($_GET['mode']=="new") {
    if ($forums[$x]=='') {
  die("Error: Invalid Forum");
}
  ?>
  
			<center>
			<U><B>Post new topic</B></U>
				<form method="POST" action="forums.php?stp=postm">
				<input type="hidden" name="thread" value="<?=$x?>">
				<input type="hidden" name="belong" value="0">
				  <table border="0" width="30%">
					<tr>
					  <td width="86%">Subject:<BR><input type="text" name="subject" size="46"></td>
					</tr>
					<tr>
					  <td width="86%" valign="top">Message:<BR><textarea rows="10" name="body" cols="45"></textarea></td>
					</tr>
					<?php
    if ( $ALLOWED_ACTIONS['forums'] == 1 ) {

        ?>
					<tr>
					  <td width="86%"><input type="checkbox" name="admin" value="1" style="border=none;"> Sticky this topic</td>
					</tr>
					<?php
    } 

    ?>
					<tr>
					  <td width="86%"><input type="submit" value="Post" name="Submit"></td>
					</tr>
				  </table>
				</form>
				<center><a href='forums.php?forum=<?=$_GET['forum']?>'>Back</a></center>
				<?
} else {

    ?>	<a href="forums.php?mode=new&forum=<?=$_GET['forum']?>"><img src="images/newtopic.png" border="0" alt="Post New Topic" title="Post New Topic"></a>		
		<table border="0" width="600">
		  <tr>
			<td width="50%" align="center"><B>Subject</B></td>
			<td width="20%" align="center"><B>Topic Starter</B></td>
			<td width="15%" align="center"><B>Replies</B></td>
			<td width="15"></td>
		  </tr>
			<?php
    $result = $db->query( "SELECT * FROM forum_messages WHERE mBelong=0 AND mThread=\"$x\" ORDER BY mAdmin DESC,mID DESC" );
    $total_topics = 0;
    $total_topics = mysql_num_rows($result);
    while ( $mbtopics = $db->fetch( $result ) ) {
        $replynum = $mbtopics['mChildren'];

        ?>
					<tr>
					  <td width="50%" style="border-bottom: 1px solid #000000;">
					  <?php
        if ( $mbtopics['mAdmin'] == 0 ) {

            ?>
						<a href='forums.php?topic=<?=$mbtopics['mID']?>' style="text-decoration: none;"><?=stripslashes( $mbtopics['mSubject'] )?></a>
						<?php
        } else {

            ?>
						<img src="images/sticky.png" border="0" title="Sticky"> <a href='forums.php?topic=<?=$mbtopics['mID']?>'><?=stripslashes( $mbtopics['mSubject'] )?></B></a>
						<?php
        } 

        ?>
					  </td>
					  <td width="20%" style="border-bottom: 1px solid #000000;" align="center">
						<?=$mbtopics['mUser']?>
					  </td>
					  <td width="15%" style="border-bottom: 1px solid #000000;" align="center">
						 <?=$replynum?>
					  </td>
					  <td width="15%">
						 <?php
        if ( $ALLOWED_ACTIONS['forums'] == 1 ) {

            ?>
							<center>
							<a href='forums.php?forum=<?=$mbtopics['mThread']?>&clp=<?=$mbtopics['mID']?>'><img src="images/delete.png" border="0"></a><br>
							</center>
							<?php
        } 

        ?>
					  </td>
					</tr>
					<?php
    } 
    if ($total_topics==0) {
	  ?>
	  					<tr>
					  <td colspan="4" align="center">
					  There are no topics in this forum.
					  </td>
					  </tr>
	  <?
	}
    ?>
			</table>
			
			<br /><br /><a href="forums.php?mode=new&forum=<?=$_GET['forum']?>"><img src="images/newtopic.png" border="0" alt="Post New Topic" title="Post New Topic"></a>
			
				<center>
			<a href='forums.php'>Back</a>
			</center>
			<?php
			}
} elseif ( $_GET['stp'] == 'postm' ) {
    echo "<center>";
    $result = $db->query( "SELECT * FROM forum_messages WHERE mID=\"" . $_POST['belong'] . "\"" );
    $mbtopic = $db->fetch( $result );

    if ( !$_POST['subject'] ) {
        echo "Your post must have a subject.";
    } elseif ( !$_POST['body'] ) {
        echo "Your post must have a body.";
    } else {
        $thebody = htmlentities( stripslashes( $_POST['body'] ) );
        $thesubject = htmlentities( stripslashes( $_POST['subject'] ) );
        $eldator = date( "d/m/Y" );
        $eladmin = $_POST['admin'];
        if ( !$eladmin ) {
            $eladmin = 0;
        } 
        $postedb = "<a href='profile.php?id=" . $user['uID'] . "'>" . $user['uLogin'] . "</a>";
        $result = $db->query( "INSERT INTO forum_messages (mBody,mSubject,mUser,mAdmin,mBelong,mThread,mDate) VALUES (\"$thebody\",\"$thesubject\",\"$postedb\",$eladmin," . $_POST['belong'] . "," . $_POST['thread'] . ",'$eldator')" );
        if ( $_POST['belong'] != 0 ) {
            $result = $db->query( "UPDATE forum_messages SET mChildren=mChildren+1 WHERE mID=\"" . $_POST['belong'] . "\"" );
        } 

        ?>
			Your reply has been posted.
			<?php
    } 

    ?>
		<BR>
		<BR>
		<?php
    if ( $_POST['belong'] == 0 ) {
        ?>
			<a href='forums.php?forum=<?=$_POST['thread']?>'>Back</a>
		<?php } else {
        ?>
			<a href='forums.php?topic=<?=$_POST['belong']?>'>Back</a>
		<?php
    } 
    echo "</center>";
} elseif ( $_GET['topic'] ) {

    ?>
		<center>
		<table width="600" border="0"><tr><td><i>Posted <?=$mbtopic['mDate']?> by <?=$mbtopic['mUser']?></i></td><td width="20" align="right">
		        </td>
        </tr>
        </table>
		</center>
		<br>
		<?=nl2br( $mbtopic['mBody'] )?>
		<BR>
		<BR>
		</td></tr>
		<tr><td class="bodycell3">
		<b><tl>Replies</tl></b>
		</td></tr>
		<?php
    $result2 = $db->query( "SELECT * FROM forum_messages WHERE mBelong=\"" . $mbtopic['mID'] . "\"" );
    while ( $replies = $db->fetch( $result2 ) ) {

        ?>
        
			<tr><td class="bodycell4">
			<hr>
			<center>
			<table width="600" border="0"><tr><td><i>Posted <?=$replies['mDate']?> by <?=$replies['mUser']?></i></td><td width="20" align="right">
			<?php
        if ( $ALLOWED_ACTIONS['forums'] == 1 ) {

            ?>
				<a href='forums.php?topic=<?=$replies['mBelong']?>&clp=<?=$replies['mID']?>'><img src="images/delete.png" border="0"></a>
				<?php
        } 

        ?>
        </td>
        </tr>
        </table>
			</center>
			<br>
			<?=nl2br( $replies['mBody'] )?>
			</td></tr>
			<?php
    } 

    ?>
		<tr><td class="bodycell3">
		Post Reply
		</td></tr>
		<tr><td class="bodycell4">
		<center>
			<form method="POST" action="forums.php?stp=postm">
			<input type="hidden" name="thread" value="<?=$mbtopic['mThread']?>">
			<input type="hidden" name="belong" value="<?=$mbtopic['mID']?>">
			<input type="hidden" name="subject" value="n/a">
			  <table border="0" width="30%">
				<tr>
				  <td width="86%" valign="top"><textarea rows="10" name="body" cols="45"></textarea></td>
				</tr>
				<tr>
				  <td width="86%"><input type="submit" value="Post" name="Submit"></td>
				</tr>
			  </table>
			</form>
		<BR>
		<?php if ( $mbtopic['mBelong'] == 0 ) {
        ?>
			<a href='forums.php?forum=<?=$mbtopic['mThread']?>'>Back</a>
		<?php } else {
        ?>
			<a href='forums.php?topic=<?=$mbtopic['mBelong']?>'>Back</a>
		<?php } 
    ?>
		</center>
		<?php
} 

?>
	</td>
  </tr>
</table>
<?php
require 'includes/footer.php';

?>
