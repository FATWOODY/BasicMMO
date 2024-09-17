<?php

$ingame = "*";
require 'includes/header.php';
?>
   <b><tl>Send Gold</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
					<?
if (isset($_POST['send'])) {
$gold = round( str_replace( "-", "", $_POST['gold'] ) );
$result = $db->query( "SELECT * FROM users WHERE uLogin=\"" . $_POST['to'] . "\"" );
$userto = $db->fetch( $result );
if (!($userto)) {
 echo "The user could not be found. Check the username of the person you want to send gold to.";
} else {
       if (($user['uGold']-$gold)<0) {
        echo "You do not have enough Gold.";
       } else {
               if (($gold>100&&$user['uLevel']<1)||($gold>1000&&$user['uLevel']<2)||($gold>10000&&$user['uLevel']<3)||($gold>100000&&$user['uLevel']<5)||($gold>1000000&&$user['uLevel']<20)) {
                  echo "You need a higher level to proccess that much Gold.";
                  } else {
                              $db->query( "UPDATE users SET uGold=(uGold-".$gold.") WHERE uLogin = '".$user['uLogin']."'" ) or die(mysql_error());
                              $db->query( "UPDATE users SET uGold=(uGold+".$gold.") WHERE uLogin = '".$userto['uLogin']."'" ) or die(mysql_error());
                              echo "Sent " . $gold . " Gold to " . $userto['uLogin'];
                  }
       }
}

} else {
  if ($user['uLevel']<7) {
   echo "You must be level 7 or above to send Gold to other players";
  } else {
    ?>
	<form action="send.php" method="post">
	<table width="300" border="0" align="center">
	  <tr>
		<td class="bodycell4" align="center" width="50%">
		<b>To:</b>
		</td>
		<td class="bodycell4" align="center" width="50%">
		<input type="text" name="to">
		</td>
	  </tr>
	  <tr>
		<td class="bodycell4" align="center" width="50%">
		<b>Amount of Gold:</b>
		</td>
		<td class="bodycell4" align="center" width="50%">
		<input type="text" name="gold">
		</td>
	  </tr>
	  <tr>
		<td colspan="2" class="bodycell4" align="center">
		<input name="send" type="submit" value="Send">
		</td>
	  </tr>
	</table>
	</form>
	<?php
	 }
}
require 'includes/footer.php';

?>