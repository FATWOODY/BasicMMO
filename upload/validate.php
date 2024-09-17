<?php
require 'includes/header.php';
?>
					<b><tl>Validate Account</tl></b><br />
					<img alt="" src="images/seperator.gif" /><br />
	<form method="POST" action="validate2.php">
		<table width="60%" border="0" align="center">
	  <tr>
		<td class="bodycell4" width="50%" align="right">
			<b>Email:</b>
		</td>
		<td class="bodycell4" width="50%">
			<input type="text" name="email" size="30">
		</td>
	  </tr>
	  <tr>
		<td class="bodycell4" width="50%" align="right">
			<b>Code:</b>
		</td>
		<td class="bodycell4" width="50%">
			<input type="text" name="code" size="30">
		</td>
	  </tr>
	  	  <tr>
		<td colspan="4" class="bodycell4">
			<center>
			<input type="submit" value="Continue >>" name="Submit">
			</center>
		</td>
	  </tr>
	</table>
	</form>
<?php
require 'includes/footer.php';
?>