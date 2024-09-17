<?php

$inadmin = "y";
require 'includes/header.php';
require 'includes/admin.php';

if ( $ALLOWED_ACTIONS['settings'] == 0 ) {
    echo "<meta http-equiv='refresh' content='1; url=index.php'>Redirecting, please hold on a moment.";
    exit();
} 

if ( !$_GET['stp'] ) {

    ?>
	<table border="0" align="center">
	  <tr>
		<th>Setting</th>
		<th>Commands</th>
	  </tr>
	  <?php
    $pnum = $_GET['p'];
    if ( !$pnum ) {
        $pnum = "Admin Settings";
    } 

    $result = $db->query( "SELECT sID,sDesc FROM settings WHERE sGroup='$pnum' ORDER BY sName ASC" );
    while ( $settings = $db->fetch( $result ) ) {
        echo "<tr>";
        echo "	<td>" . $settings['sDesc'] . "</td>";
        echo "	<td align=\"center\"><a href=\"admin_settings.php?stp=edit&id=" . $settings['sID'] . "\"><img src=\"images/b_edit.gif\" border=\"0\"></a></td>";
        echo "</tr>";
    } 

    ?>
	  <tr>
		<td colspan="4" align="center">
			<br><br>
			<?php
    $result = $db->query( "SELECT sGroup, count(*) AS sCount FROM settings GROUP BY sGroup" );
    $pnum2 = 0;
    while ( $temp = $db->fetch( $result ) ) {
        if ( $temp['sGroup'] != $pnum ) {
            echo "<a href='admin_settings.php?p=" . $temp['sGroup'] . "'>" . $temp['sGroup'] . "</a> ";
        } else {
            echo "<b>" . $temp['sGroup'] . "</b> ";
        } 
        $pnum2++;
        echo "| ";
        if ( $pnum2 == 3 || $pnum2 == 6 ) {
            echo "<br>";
        } 
    } 

    ?>
		</td>
	  </tr>
	</table>
	<?php
} elseif ( $_GET['stp'] == "edit" ) {
    $editid = round( $_GET['id'] );
    $result = $db->query( "SELECT sID,sDesc,sValue FROM settings WHERE sID='$editid'" );
    $settings = $db->fetch( $result );
    $showthis = "<input name=\"sid\" type=\"hidden\" value=\"$editid\">";

    ?>
	<form action="admin_settings.php?stp=edit2&sid=<?=$editid?>" method="post">
	<table border="0" align="center">
	  <tr>
		<td>
			<?=$showthis?>
			<b>Setting</b>
			<br>
			<?=$settings['sDesc']?>
			<br>
			<br>
			<b>Value</b>
			<br>
			<textarea name="svalue" rows="10" cols="45"><?=$settings['sValue']?></textarea>
			<br><br>
			<input name="sumbit" type="submit" value="Edit">
		</td>
	  </tr>
	</table>
	</form>
	<?php
} elseif ( $_GET['stp'] == "edit2" ) {
    if ( !$_POST['svalue'] ) {
        echo "You did not complete all of the fields.";
    } else {
        $svalue = htmlentities( $_POST['svalue'] );
        $edid = $_GET['sid'];
        if ( !$edid ) {
            $edid = $_POST['sid'];
        } 
        $db->query( "UPDATE settings SET sValue=\"$svalue\" WHERE sID='" . $_GET['sid'] . "'" );
        echo "You successfully updated this setting.";
    } 
} 
require 'includes/footer.php';


?>