<?php

$ingame = "*";
require 'includes/header.php';
if ( !$_POST['update'] ) {

    ?>
<b><tl>Account</tl></b><br />
<img alt="" src="images/seperator.gif" /><br />
	<form action="account.php" method="post">
	<table width="350" border="0" align="center">
	  <tr>
		<td class="bodycell4" align="center" width="50%" valign="top">
		<br><br><b>Profile:</b>
		</td>
		<td class="bodycell4" align="center" width="50%">
		<textarea name="profile" cols="30" rows="6"><?=$user['uProfile']?></textarea>
		</td>
	  </tr>
	  <tr>
		<td colspan="2" class="bodycell4" align="center">
		<input name="update" type="submit" value="Update">
		</td>
	  </tr>
	</table>
	</form>
	<?php
} elseif ( $_POST[update] ) {

    ?>
    <b><tl>Account</tl></b><br />
<img alt="" src="images/seperator.gif" /><br />
	<table width="100%" border="0" align="center">
	  <tr>
		<td class="bodycell4" align="center">
			<?php
    $proftext = htmlspecialchars( stripslashes( $_POST['profile'] ), ENT_QUOTES, 'UTF-8' );
    echo "You sucessfully edited your account.";
    $db->query( "UPDATE users SET uProfile=\"$proftext\" WHERE uID='" . $user['uID'] . "'" );

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