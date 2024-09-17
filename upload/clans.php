<?php

$ingame = "*";
require 'includes/header.php';
if ($user['uRank']!=5) {
  echo "<center><h1>Clans</h1>Access Denied: This is in developement</center><br /><br />Ideas for clans are required! How will they work, what do members/admins control? Post them in the forums.<br />-Bullite";
  require 'includes/footer.php';
  exit;
}
if ($user['clan']==0) {
  ?>
  	<table width="100%" border="0" align="center">
	  <tr>
		<td class="bodycell3">Clans</td>
	  </tr>
	  <tr>
		<td class="bodycell4" align="center" width="50%">
  You are not a member of a clan, below are a list of clans that are avalible to join in order of rank<br />
  <?
      $clans_total = $db->fetch( $db->query( "SELECT count(*) FROM clans" ) );
    $pages = ceil( $clans_total[0] / 25 );

    if ( $_GET['p'] ) {
        $currentpage = round( $_GET['p'] );
    } else {
        $currentpage = round( $_POST['page'] )-1;
    } 
    if ( $currentpage < 1 ) {
        $currentpage = 0;
    } 
    if ( $currentpage + 1 > $pages ) {
        $currentpage = $pages-1;
    } 
    $lmin = $currentpage * 25;
    $lmax = $lmin + 25;

    if ( $_POST['find_username'] ) {
        $theuser = htmlentities( stripslashes( $_POST['username'] ) );
        $whereclause = " WHERE uLogin LIKE \"%$theuser%\"";
    } 

    ?>
	<form action="clans.php" method="post">
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell3" width="50%">Find By Page</td>
		<td class="bodycell3" width="50%">Find By Name</td>
	  </tr>
	  <tr>
		<td class="bodycell4" width="50%" align="center">
			<br>
			<input name="page" size="5" maxlength="10" type="number"> / <?=$pages?><br><br>
			<input name="find_page" value="Submit" type="submit"><br><br>
		</td>
		<td class="bodycell4" width="50%" align="center">
			<br>
			<input name="username" size="10" maxlength="30" type="text"><br><br>
			<input name="find_username" value="Submit" type="submit"><br><br>
		</td>
	  </tr>
	</table>
	</form>
	<?php
    $x = $currentpage * 25;
    if ( $x < 0 ) {
        $x = 0;
    } 
    $column1 .= "<b>Rank</b><br>";
    $column2 .= "<b>Username</b><br>";
    $column3 .= "<b>Gold</b><br>";
    $column4 .= "<b>Army Size</b><br>";
    $column5 .= "<b>Level</b><br>";
    $thequery = "SELECT id, name, gold FROM clans$whereclause ORDER BY exp DESC LIMIT $lmin, 25";
    $result = $db->query( $thequery ) or die(mysql_error());
    while ( $themost = $db->fetch( $result ) ) {
        $x++;
        if ($x==1) {
		$column1 .= "<hr><img src=\"../images/r_1.png\" border=\"0\" title=\"1\" alt=\"1\"><br>";  
		} else if ($x==2) {
		$column1 .= "<hr><img src=\"../images/r_2.png\" border=\"0\" title=\"2\" alt=\"2\"><br>";  
		} else if ($x==3) {
		$column1 .= "<hr><img src=\"../images/r_3.png\" border=\"0\" title=\"3\" alt=\"3\"><br>";  
		} else {
        $column1 .= "<hr>$x<br>";
        }
        $column2 .= "<hr><a href=\"clans.php?mode=profile&id=" . $themost['id'] . "\">" . $themost['name'] . "</a> ";
            $column2 .= "<br>";
        $column3 .= "<hr>" . $themost['gold'] . "<br>";
        $column4 .= "<hr>" . $themost['uArmySize'] . "<br>";
        $column5 .= "<hr>" . $themost['uLevel'] . "<br>";
    } 

    ?>
	<table width="100%"  border="0">
	  <tr>
		<td class="bodycell4">
		<table width="90%" border="0" align="center">
		  <tr>
			<td align="left">
				<?php
    if ( $currentpage > 0 ) {

        ?>
					<a href="clans.php?p=<?=$currentpage-1?>">Previous</a>
					<?php
    } else {
        echo "Previous";
    } 

    ?>
			</td>
			<td align="right">
				<?php
    if ( $currentpage + 1 < $pages ) {

        ?>
					<a href="clans.php?p=<?=$currentpage + 1?>">Next</a>
					<?php
    } else {
        echo "Next";
    } 

    ?>
			</td>
		  </tr>
		</table>
		</td>
	  </tr>
	  <tr>
		<td class="bodycell4">
		<table width="100%" border="0">
		  <tr>
			<td width="10%" align="center">
			<?=$column1?>
			</td>
			<td width="35%">
			<?=$column2?>
			</td>
			<td width="25%" align="center">
			<?=$column3?>
			</td>
			<td width="20%" align="center">
			<?=$column4?>
			</td>
			<td width="10%" align="center">
			<?=$column5?>
			</td>
		  </tr>
		</table>
		</td>
	  </tr>
	  <tr>
		<td class="bodycell4">
		<table width="90%" border="0" align="center">
		  <tr>
			<td align="left">
				<?php
    if ( $currentpage > 0 ) {

        ?>
					<a href="clans.php?p=<?=$currentpage-1?>">Previous</a>
					<?php
    } else {
        echo "Previous";
    } 

    ?>
			</td>
			<td align="right">
				<?php
    if ( $currentpage + 1 < $pages ) {

        ?>
					<a href="clans.php?p=<?=$currentpage + 1?>">Next</a>
					<?php
    } else {
        echo "Next";
    } 

    ?>
  
  		</td>
	  </tr>
	  </table>
  <?
}
require 'includes/footer.php';

?>