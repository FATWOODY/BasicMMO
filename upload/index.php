<?
require "includes/header.php";
?>
<br>
<table width="60%" border="0" align="center">
  <tr>
    <td align="center" colspan="2">
		<?=$SETTINGS['game_descr']?>
		<br><br>
	</td>
  </tr>
  <tr>
    <td align="center">
		<a href="register.php"><img src="images/register1.png" border="0" height="63" width="200"></a>
	</td>
    <td align="center">
		<a href="login.php"><img src="images/login1.png" border="0" height="63" width="200"></a>
	</td>
  </tr>
</table>
<center><a href="validate.php">Validate Your Account</a></center>
<?
require 'includes/footer.php';
?>